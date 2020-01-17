<?php
class DaoProperty extends Dao {
	private const QUERY_CREATE = "call insertProperty(:name,:area,:description,:type,:location,:user)"; //TODO
	private const QUERY_GET_ALL = "CALL getAllProperty()";
	private const QUERY_GET_BY_ID = "CALL getPropertyById(:id)";
	private const QUERY_DELETE_BY_ID = "CALL deletePropertyById(:id)";
	private $_property;

	/**
	 * DaoProperty constructor.
	 *
	 * @param Property $property
	 */
	public function __construct ($property) {
		parent::__construct();
		$this->_property = $property;
	}

	/**
	 * @return Property
	 * @throws DatabaseConnectionException
	 */
	public function createProperty () {
		try {
			$name = $this->_property->getName();
			$description = $this->_property->getDescription();
			$area = $this->_property->getArea();
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":description", $description, PDO::PARAM_STR);
			$stmt->bindParam(":area", $area, PDO::PARAM_STR);
			$stmt->execute();

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Property[]
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function getAllProperty () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyNotFoundException("There are no property found", 404);
			else {
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Property
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function getPropertyById () {
		try {
			$id = $this->_property->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyNotFoundException("There are no property found", 404);
			else {
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function deletePropertyByPropertyId () {
		try {
			$id = $this->_property->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyNotFoundException("There are no property found", 404);

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
	 * @return Property
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createProperty($dbObject->id, $dbObject->name, $dbObject->area, $dbObject->description,
			$dbObject->state, $dbObject->floor, $dbObject->active, $dbObject->delete, $dbObject->user_created,
			$dbObject->user_modifier, $dbObject->date_created, $dbObject->date_modified);
	}
}