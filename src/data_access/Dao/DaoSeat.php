<?php
class DaoSeat extends Dao {
	private const QUERY_CREATE = "";
	private const QUERY_GET_ALL = "SELECT sea_id id, sea_name name, sea_rif rif FROM seat";
	private const QUERY_GET_BY_ID = "SELECT sea_id id, sea_name name, sea_rif rif FROM seat WHERE sea_id = :id";

	/**
	 * DaoSeat constructor.
	 */
	public function __construct () {
		parent::__construct();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	public function getSeatById ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new SeatNotFoundException("There are no seat found", 200);
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
		return FactoryEntity::createSeat($dbObject->id, $dbObject->name, $dbObject->rif);
	}

	/**
	 * @return Seat[]
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	public function getAllSeat () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new SeatNotFoundException("There are no seat found", 200);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $e) {
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}
}