<?php
class DaoLocation extends Dao {
	private const QUERY_GET_BY_NAME = "Select lo_id id, lo_name name,lo_type type from location where lo_name=:name";
	private const QUERY_GET_BY_TYPE = "Select lo_id id, lo_name name,lo_type type from location where lo_type=:type";
	private const QUERY_GET_BY_ID = "Select lo_id id, lo_name name,lo_type type from location where lo_id=:id";
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
	 *
	 * @return Location
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 */
	public function getLocationById () {
		try {
			$id = $this->_location->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new LocationNotFoundException("There are no Location found", 200);
			else {
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $e) {
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
        catch (PDOException $e) {
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
		catch (PDOException $e) {
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $dbObject
	 *
	 * @return Location
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createLocation($dbObject->id,$dbObject->name,$dbObject->type);
	}
}