<?php
class DaoPropertyExtra extends Dao {
	private const QUERY_CREATE = "CALL insertPropertyExtra(:value, :property, :extra, :user,:dateCreated);";
	private const QUERY_GET_BY_ID = "CALL getPropertyExtraById(:id)";
	private const QUERY_GET_BY_PROPERTY_ID = "CALL getPropertyExtraByPropertyId(:id)";
	private const QUERY_DELETE = "CALL getPropertyExtraByPropertyId(:id)";
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
	 * @return PropertyExtra
	 * @throws DatabaseConnectionException
	 */
	public function createPropertyExtra () {
		try {
			$value = $this->_entity->getValue();
			$property = $this->_entity->getPropertyId();
			$extra = $this->_entity->getExtraId();
			$user = 1; // TODO: replace for logged user
			if ($this->_entity->getDateCreated() == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":value", $value, PDO::PARAM_STR);
			$stmt->bindParam(":property", $property, PDO::PARAM_INT);
			$stmt->bindParam(":extra", $extra, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
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
	 * @return PropertyExtra
	 * @throws DatabaseConnectionException
	 * @throws PropertyExtraNotFoundException
	 */
	public function getPropertyExtraById () {
		try {
			$id = $this->_entity->getId();
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
	 * @param $dbObject
	 *
	 * @return PropertyExtra
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createPropertyExtra($dbObject->id, $dbObject->name, $dbObject->value, $dbObject->property,
			$dbObject->extra, $dbObject->userCreator, $dbObject->userModifier, $dbObject->dateCreated,
			$dbObject->dateModified, $dbObject->active, $dbObject->delete);
	}
}