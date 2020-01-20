<?php
class DaoPropertyPrice extends Dao {
	//insertpropertyprice(price double(20,2), final tinyint,property int,user int)
	private const QUERY_CREATE = "CALL insertPropertyPrice(:price,:final,:property,:user)";
	private const QUERY_GET_ALL = "CALL getAllPropertyPrice()";
	private const QUERY_GET_BY_ID = "CALL getPropertyPricebyId(:id)";
	private const QUERY_GET_PRICE_BY_PROPERTY_ID = "CALL getPropertyPriceByPropertyId(:id)";
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
	 * @throws InvalidPropertyPriceException
	 */
	public function getPropertyPriceById () {
		try {
			$id = $this->_entity->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new InvalidPropertyPriceException("There are no price for this property found", 200);
			else
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
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
		return FactoryEntity::createPropertyPrice($dbObject->id, $dbObject->price,
			$dbObject->date, $dbObject->final);
	}
}