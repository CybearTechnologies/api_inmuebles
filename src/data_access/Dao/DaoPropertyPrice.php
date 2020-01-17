<?php
class DaoPropertyPrice extends Dao {
	//insertpropertyprice(price double(20,2), final tinyint,property int,user int)
	private const QUERY_CREATE_PROPERTY_PRICE = "CALL insertPropertyPrice(:price,:final,:property,:user)";
	private const QUERY_GET_ALL = "CALL getAllPropertyPrice()";
	private const QUERY_GET_BY_ID = "CALL getPropertyPriceById(:id)";
	private const QUERY_GET_PRICE_BY_PROPERTY_ID = "CALL getAllPricesByProperty(:id)";
	private $_entity;

	/**
	 * DaoPropertyPrice constructor.
	 *
	 * @param PropertyPrice|Property $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}

	/**
	 * @return PropertyPrice[]
	 * @throws DatabaseConnectionException
	 * @throws InvalidPropertyPriceException
	 */
	public function getPriceByPropertyId () {
		try {
			$id = $this->_entity->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_PRICE_BY_PROPERTY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new InvalidPropertyPriceException("There are no price for this property found", 200);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return PropertyPrice
	 * @throws DatabaseConnectionException
	 * @throws PropertyTypeNotFoundException
	 */
	public function getPropertyPriceById () {
		try {
			$id = $this->_entity->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyTypeNotFoundException("There are no property type found", 404);
			else
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return PropertyPrice
	 * @throws DatabaseConnectionException
	 */
	public function createPropertyPrice () {
		try {
			$id = $this->_entity->getId();
			$price = $this->_entity->getPrice();
			$date = $this->_entity->getDate();
			$final = $this->_entity->isFinal();
			$propertyId = $this->_entity->getPropertyId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE_PROPERTY_PRICE);
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(':price', $price, PDO::PARAM_INT);
			$stmt->bindParam(":date", $date, PDO::PARAM_STR);
			$stmt->bindParam(':final', $final, PDO::PARAM_INT);
			$stmt->bindParam(':propertyId', $propertyId, PDO::PARAM_INT);
			$stmt->execute();

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return PropertyPrice[]
	 * @throws DatabaseConnectionException
	 * @throws PropertyTypeNotFoundException
	 */
	public function getAllPropertyPrice () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyTypeNotFoundException("There are no Property Type found", 404);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $dbObject
	 *
	 * @return PropertyPrice
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createPropertyPrice($dbObject->id, $dbObject->price, $dbObject->date,
			$dbObject->final, $dbObject->propertyId);
	}
}