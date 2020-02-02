<?php
class DaoSeat extends Dao {
	private const QUERY_GET_ALL = "CALL getAllSeats()";
	private const QUERY_GET_BY_ID = "CALL getSeatById(:id)";
	private const QUERY_GET_SEATS_BY_AGENCY = "CALL getSeatsByAgency(:id)";
	private const QUERY_DELETE = "CALL deleteSeat(:id,:user)";
	private const QUERY_CREATE = "CALL insertSeat(:name,:rif,:location,:agency,:user,:dateCreated)";
	private const QUERY_UPDATE = "CALL updateSeat(:id,:name,:rif,:location,:agency,:user,dateModified)";
	private $_entity;

	/**
	 * DaoSeat constructor.
	 *
	 * @param Seat|Agency $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}

	/**
	 * @return Seat
	 * @throws DatabaseConnectionException
	 */
	public function createSeat () {
		try {
			$name = $this->_entity->getName();
			$rif = $this->_entity->getRif();
			$location = $this->_entity->getLocation();
			$agency = $this->_entity->getAgency();
			$user = $this->_entity->getUserCreator();
			$dateCreated = $this->_entity->getDateCreated();
			if ($this->_entity->getDateCreated() == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":rif", $rif, PDO::PARAM_STR);
			$stmt->bindParam(":location", $location, PDO::PARAM_STR);
			$stmt->bindParam(":agency", $agency, PDO::PARAM_STR);
			$stmt->bindParam(":user", $user, PDO::PARAM_STR);
			$stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
			$stmt->execute();

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Seat
	 * @throws DatabaseConnectionException
	 */
	public function updateSeat () {
		try {
			$id = $this->_entity->getId();
			$name = $this->_entity->getName();
			$rif = $this->_entity->getRif();
			$location = $this->_entity->getLocation();
			$agency = $this->_entity->getAgency();
			$user = $this->_entity->getUserModifier();
			$dateCreated = $this->_entity->getDateModified();
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":rif", $rif, PDO::PARAM_STR);
			$stmt->bindParam(":location", $location, PDO::PARAM_STR);
			$stmt->bindParam(":agency", $agency, PDO::PARAM_STR);
			$stmt->bindParam(":user", $user, PDO::PARAM_STR);
			$stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
			$stmt->execute();

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
	public function getAllSeatsByAgency () {
		try {
			$id = $this->_entity->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_SEATS_BY_AGENCY);
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
	 * @return Seat
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	public function getSeatById () {
		try {
			$id = $this->_entity->getId();
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
	 * @return Seat
	 * @throws DatabaseConnectionException
	 */
	public function deleteSeat () {
		try {
			$id = $this->_entity->getId();
			$user = $this->_entity->getUserModifier();
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->execute();

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
	 * @param $dbObject
	 *
	 * @return Seat
	 */
	protected function extract ($dbObject):Seat {
		return FactoryEntity::createSeat($dbObject->id, $dbObject->name, $dbObject->rif, $dbObject->location,
			$dbObject->agency, $dbObject->userCreator, $dbObject->userModifier, $dbObject->dateCreated,
			$dbObject->dateModified, $dbObject->active, $dbObject->delete);
	}
}