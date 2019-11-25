<?php
class DaoExtra extends Dao {
	private const QUERY_CREATE = "";
	private const QUERY_GET_ALL = "Select ext_id id, ext_name name from extra";
	private const QUERY_GET_BY_ID = "Select ext_id id, ext_name name from extra where ext_id=:id";
	private const QUERY_GET_BY_PROPERTY_ID = "";

	/**
	 * @param $id
	 *
	 * @return Extra
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function getExtraById ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new ExtraNotFoundException("There are no Extra found", 404);
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
	 * @return Extra[]
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function getAllPropertyExtra ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_PROPERTY_ID);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new ExtraNotFoundException("There are no Extra found for this property", 404);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Extra[]
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function getAllExtra () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new ExtraNotFoundException("There are no Extra found", 404);
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
	 * @return Extra
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createExtra($dbObject->id, $dbObject->name);
	}
}