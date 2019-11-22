<?php
class DaoRequest extends Dao {
	private const QUERY_CREATE = "";
	private const QUERY_GET_ALL = "SELECT req_id id, req_date date FROM request";
	private const QUERY_GET_BY_ID = "SELECT req_id id, req_date date FROM request WHERE req_id = :id";
	private const QUERY_GET_BY_USER_ID = "SELECT req_id id, req_date date FROM request WHERE req_user_fk = :id";
	private const QUERY_GET_BY_PROPERTY_ID = "SELECT req_id id, req_date date FROM request WHERE req_property_fk = :id";

	/**
	 * DaoRequest constructor.
	 */
	public function __construct () {
		parent::__construct();
	}

	/**
	 * @param $id
	 *
	 * @return array
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function getAllRequestByPropertyId ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_PROPERTY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RequestNotFoundException("There are no request found", 200);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $e) {
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $id
	 *
	 * @return array
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function getAllRequestByUserId ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_USER_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RequestNotFoundException("There are no request found", 200);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $e) {
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return array
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function getAllRequest () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RequestNotFoundException("There are no request found", 200);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $e) {
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function getRequestById ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RequestNotFoundException("There are no request found", 200);
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
		return FactoryEntity::createRequest($dbObject->id, $dbObject->date);
	}
}