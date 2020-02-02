<?php
class DaoPropertyPrice extends Dao {
	private const QUERY_CREATE = "CALL insertPropertyPrice(:price,:final,:property,:user)";
	private const QUERY_GET_ALL = "CALL getAllPropertyPrice()";
	private const QUERY_GET_BY_ID = "CALL getPropertyPricebyId(:id)";
	private const QUERY_GET_PRICE_BY_PROPERTY_ID = "CALL getPropertyPriceByPropertyId(:id)";
	private const QUERY_DELETE = "CALL deletePropertyPrice(:id,:user)";
	private $_entity;

	/**
	 * DaoPropertyPrice constructor.
	 *
	 * @param PropertyPrice[] $entity
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
			$id = $this->_entity[0]->getId();
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
			$id = $this->_entity[0]->getId();
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
	 * @return PropertyPrice
	 * @throws DatabaseConnectionException
	 * @throws InvalidPropertyPriceException
	 */
	public function createPropertyPrice () {
		try {
			$this->_entity[0]->getPrice();
			$price = $this->_entity[0]->getPrice();
			$final = $this->_entity[0]->getFinal();
			$property = $this->_entity[0]->getPropertyId();
			$user = $this->_entity[0]->getUserCreator();
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":price", $price, PDO::PARAM_STR);
			$stmt->bindParam(":final", $final, PDO::PARAM_STR);
			$stmt->bindParam(":property", $property, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
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
	 * @return PropertyPrice[]
	 * @throws DatabaseConnectionException
	 * @throws InvalidPropertyPriceException
	 */
	public function getAllPropertyPrice () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
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
	 * @return array
	 * @throws DatabaseConnectionException
	 * @throws InvalidPropertyPriceException
	 */
	public function deletePropertyPrice () {
		try {
			$id = $this->_entity[0]->getId();
			$user = $this->_entity[0]->getUserModifier();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
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
	 * @param $dbObject
	 *
	 * @return PropertyPrice
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createPropertyPrice($dbObject->id, $dbObject->price,
			$dbObject->property, $dbObject->final, $dbObject->active, $dbObject->delete, $dbObject->userCreator,
			$dbObject->userModifier, $dbObject->dateCreated, $dbObject->dateModified);
	}
}