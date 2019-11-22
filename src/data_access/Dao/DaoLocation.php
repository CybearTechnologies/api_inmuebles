<?php
class DaoLocation extends Dao {
	private const QUERY_CREATE = "";
	private const QUERY_GET_BY_NAME = "Select loc_id id, loc_name name,loc_type type from location where loc_name=':name'";
	private const QUERY_GET_BY_TYPE = "Select loc_id id, loc_name name,loc_type type from location where loc_type=':type'";
	private const QUERY_GET_BY_ID = "Select loc_id id, loc_name name,loc_type type from location where loc_id=:id";

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
	 * @param $name
	 *
	 * @return mixed
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 */
	public function getLocationByName ($name) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_NAME);
			$stmt->bindParam(":name", $name, PDO::PARAM_INT);
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
	public function getLocationByType ($type) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_TYPE);
			$stmt->bindParam(":type", $type, PDO::PARAM_INT);
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
	 * @param $dbObject
	 *
	 * @return mixed
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createLocation($dbObject->id,$dbObject->name,$dbObject->type);
	}
}