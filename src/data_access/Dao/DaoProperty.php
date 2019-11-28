<?php
class DaoProperty extends Dao {
	private const QUERY_CREATE = "";
	private const QUERY_GET_ALL = "CALL getAllProperty()";
	private const QUERY_GET_BY_ID = "CALL getPropertyById(:id)";

	/**
	 * DaoProperty constructor.
	 */
	public function __construct () {
		parent::__construct();
	}

	/**
	 * @param Property $property
	 */
	public function createProperty ($property) {
		$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
		$stmt->bindParam(":name", $property->getName(), PDO::PARAM_STR);
		$stmt->bindParam(":description", $property->getDescription(), PDO::PARAM_STR);
		$stmt->bindParam(":area", $property->getArea(), PDO::PARAM_STR);
		$stmt->execute();
	}

	/**
	 * @return Property
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
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $id
	 *
	 * @return Property
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function getPropertyById ($id) {
		try {
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
	 * @param $dbObject
	 *
	 * @return Property
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createProperty($dbObject->id, $dbObject->name, $dbObject->area, $dbObject->description,
			$dbObject->publishDate, $dbObject->state, $dbObject->floor);
	}
}