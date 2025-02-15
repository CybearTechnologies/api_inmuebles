<?php
class DaoPropertyPrice extends Dao {
	private const QUERY_CREATE = "CALL insertPropertyPrice(:price,:final,:property,:user,:dateCreated)";
	private const QUERY_GET_ALL = "CALL getAllPropertyPrice()";
	private const QUERY_GET_BY_ID = "CALL getPropertyPriceById(:id)";
	private const QUERY_GET_PRICE_BY_PROPERTY_ID = "CALL getPropertyPriceByPropertyId(:id)";
	private const QUERY_GET_LAST_TWO = "CALL getPropertyTwoLastPriceByPropertyId(:id)";
	private const QUERY_DELETE = "CALL deletePropertyPrice(:id,:user)";
	private $_entity;

	/**
	 * DaoPropertyPrice constructor.
	 *
	 * @param PropertyPrice $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}

	/**
	 * @param     $price
	 * @param int $propertyId
	 * @param int $creator
	 *
	 * @return PropertyPrice
	 * @throws DatabaseConnectionException
	 */
	public function createPropertyPrice ($price, int $propertyId, int $creator) {
		try {
			$final = true;
			$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":price", $price, PDO::PARAM_STR);
			$stmt->bindParam(":final", $final, PDO::PARAM_BOOL);
			$stmt->bindParam(":property", $propertyId, PDO::PARAM_INT);
			$stmt->bindParam(":user", $creator, PDO::PARAM_INT);
			$stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
			$stmt->execute();

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int $id
	 *
	 * @return PropertyPrice[]
	 * @throws DatabaseConnectionException
	 * @throws InvalidPropertyPriceException
	 */
	public function getPropertyPriceByPropertyId ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_PRICE_BY_PROPERTY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new InvalidPropertyPriceException("There are no price for this property found", 404);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int $id
	 *
	 * @return PropertyPrice[]
	 * @throws DatabaseConnectionException
	 * @throws InvalidPropertyPriceException
	 */
	public function getPropertyPriceById (int $id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new InvalidPropertyPriceException("There are no price with id: " . $id, 404);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int $id
	 *
	 * @return array
	 * @throws DatabaseConnectionException
	 * @throws InvalidPropertyPriceException
	 */
	public function getLastTwoPropertyPriceByProperty (int $id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_LAST_TWO);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new InvalidPropertyPriceException("There are no price with id: " . $id, 404);
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
		return FactoryEntity::createPropertyPrice($dbObject->id, $dbObject->price, $dbObject->final,
			$dbObject->property, $dbObject->userCreator, $dbObject->userModifier, $dbObject->dateCreated,
			$dbObject->dateModified, $dbObject->active, $dbObject->delete);
	}
}