<?php
class DaoExtra extends Dao {
	private const QUERY_CREATE = "";
	private const QUERY_GET_ALL = "Select ext_id id, ext_name name from extra";
	private const QUERY_GET_BY_ID = "Select ext_id id, ext_name name from extra where ext_id=:id";

	/**
	 * @param $id
	 *
	 * @return mixed
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function getExtraById ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new ExtraNotFoundException("There are no Extra found", 200);
			else {
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $e) {
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Extra[]
	 * @throws ExtraNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function getAllExtra () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new ExtraNotFoundException("There are no Extra found", 200);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
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
		return FactoryEntity::createExtra($dbObject->id, $dbObject->name);
	}
}