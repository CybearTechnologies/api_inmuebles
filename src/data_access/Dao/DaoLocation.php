<?php
class DaoLocation extends Dao {
	private const QUERY_GET_BY_NAME = "CALL getLocationsByName(:name)";
	private const QUERY_GET_BY_TYPE = "CALL getLocationsByType(:type)";
	private const QUERY_GET_BY_ID = "CALL getLocationsById(:id)";
	private const QUERY_GET_ALL_LOCATIONS = "CALL getAllLocations()";
	private const QUERY_GET_BY_STATE = "CALL getLocationsByStateId(:id)";
	private const QUERY_GET_BY_MUNICIPALITY = "CALL getLocationsByMunicipalityId(:id)";

	private $_location;

	/**
	 * DaoLocation constructor.
	 *
	 * @param Location $location
	 */
	public function __construct ($location) {
		parent::__construct();
		$this->_location = $location;
	}

	/**
	 * @param int $id
	 *
	 * @return Location
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 */
	public function getLocationById (int $id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new LocationNotFoundException("There are no Location found", 200);
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
	 * @return Location
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 */
	public function getLocationByName () {
		try {
			$name = $this->_location->getName();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_NAME);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new LocationNotFoundException("There are no Location found", 200);
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
	 * @return Location[]
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 */
	public function getLocationsByType () {
		try {
			$type = $this->_location->getType();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_TYPE);
			$stmt->bindParam(":type", $type, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new LocationNotFoundException("There are no Location found", 404);
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
	 * @param $id
	 *
	 * @return Location[]
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 */
	public function getLocationByState ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_STATE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new LocationNotFoundException("There are no Location found", 404);
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
	 * @param $id
	 *
	 * @return Location
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 */
	public function getLocationByMunicipality ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_MUNICIPALITY);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new LocationNotFoundException("There are no Location found", 404);
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
	 * @return Location
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createLocation($dbObject->id, $dbObject->name, $dbObject->type, $dbObject->userCreator,
			$dbObject->userModifier, $dbObject->dateCreated, $dbObject->dateModified, $dbObject->active,
			$dbObject->delete);
	}
}