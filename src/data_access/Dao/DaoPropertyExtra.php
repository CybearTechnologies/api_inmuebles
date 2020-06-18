<?php
class DaoPropertyExtra extends Dao {
	private const QUERY_CREATE = "CALL insertPropertyExtra(:value, :property, :extra, :user,:dateCreated);";
	private const QUERY_GET_BY_ID = "CALL getPropertyExtraById(:id)";
	private const QUERY_GET_BY_PROPERTY_ID = "CALL getPropertyExtraByPropertyId(:id)";
	private const QUERY_DELETE = "CALL getPropertyExtraByPropertyId(:id)";
	private const QUERY_DELETE_BY_PROPERTY_ID = "CALL deleteExtrasByPropertyId(:id,:user,:dateModified)";
	private $_entity;

	/**
	 * DaoPropertyExtra constructor.
	 *
	 * @param PropertyExtra $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}

	/**
	 * @param PropertyExtra $entity
	 */
	public function setEntity (PropertyExtra $entity):void {
		$this->_entity = $entity;
	}

	/**
	 * @param int $id
	 * @param int $amount
	 * @param int $property
	 * @param int $creator
	 *
	 * @return PropertyExtra
	 * @throws DatabaseConnectionException
	 */
	public function createPropertyExtra (int $id, int $amount, int $property, int $creator) {
		try {
			$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":value", $amount, PDO::PARAM_INT);
			$stmt->bindParam(":property", $property, PDO::PARAM_INT);
			$stmt->bindParam(":extra", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $creator, PDO::PARAM_INT);
			$stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
			$stmt->execute();

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int $id
	 *
	 * @return PropertyExtra
	 * @throws DatabaseConnectionException
	 * @throws PropertyExtraNotFoundException
	 */
	public function getPropertyExtraById ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyExtraNotFoundException("Property Extra Not found", 200);
			else
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $propertyId
	 *
	 * @return PropertyExtra[]
	 * @throws DatabaseConnectionException
	 * @throws PropertyExtraNotFoundException
	 */
	public function getPropertyExtraByPropertyId ($propertyId) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_PROPERTY_ID);
			$stmt->bindParam(":id", $propertyId, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyExtraNotFoundException("Property Extra Not found", 200);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return PropertyExtra
	 * @throws DatabaseConnectionException
	 */
	public function deletePropertyExtraById () {
		try {
			$id = $this->_entity->getId();
			$user = 1; // TODO: replace for logged user
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->execute();

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int    $id
	 * @param int    $user
	 * @param string $dateModified
	 *
	 * @throws DatabaseConnectionException
	 */
	public function deleteExtrasByPropertyId (int $id, int $user, string $dateModified) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE_BY_PROPERTY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $dbObject
	 *
	 * @return PropertyExtra
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createPropertyExtra($dbObject->id, $dbObject->value, $dbObject->property,
			$dbObject->extra, $dbObject->userCreator, $dbObject->userModifier, $dbObject->dateCreated,
			$dbObject->dateModified, $dbObject->active, $dbObject->delete);
	}
}