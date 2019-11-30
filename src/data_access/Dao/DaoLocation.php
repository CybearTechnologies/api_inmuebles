<?php
class DaoLocation extends Dao {
	private const QUERY_GET_BY_NAME = "Select lo_id id, lo_name name,lo_type type from location where lo_name=:name";
	private const QUERY_GET_BY_TYPE = "Select lo_id id, lo_name name,lo_type type from location where lo_type=:type";
	private const QUERY_GET_BY_ID = "Select lo_id id, lo_name name,lo_type type from location where lo_id=:id";

	/**
	 * @param $id
	 *
	 * @return mixed
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 */
	public function getLocationById ($id) {
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
		catch (PDOException $e) {
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

    /**
     * @param $type
     *
     * @return mixed
     * @throws DatabaseConnectionException
     * @throws LocationNotFoundException
     */
    public function getLocationByName ($type) {
        try {
            $stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_NAME);
            $stmt->bindParam(":name", $type, PDO::PARAM_STR);
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
	 * @param string $type
	 *
	 * @return Location[]
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 */
	public function getLocationsByType ($type) {
		try {
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