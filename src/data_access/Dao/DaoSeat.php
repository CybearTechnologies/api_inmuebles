<?php
class DaoSeat extends Dao {
	private const QUERY_GET_ALL = "CALL getAllSeats()";
	private const QUERY_GET_BY_ID = "CALL getSeatById(:id)";
	private const QUERY_GET_BY_AGENCY = "CALL getAllSeatsByAgency(:id)";

	/**
	 * DaoSeat constructor.
	 */
	public function __construct () {
		parent::__construct();
	}

	/**
	 * @param int $id
	 *
	 * @return Seat
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	public function getSeatById ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new SeatNotFoundException("There are no seats found", 404);
			else
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Seat[]
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	public function getAllSeats () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new SeatNotFoundException("There are no seat found", 404);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int $id
	 *
	 * @return Seat[]
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	public function getAllSeatsByAgency ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_AGENCY);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new SeatNotFoundException("There are no seat found in this agency", 404);
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
	 * @return Seat
	 */
	protected function extract ($dbObject):Seat {
		return FactoryEntity::createSeat($dbObject->id, $dbObject->name, $dbObject->rif, $dbObject->active);
	}
}