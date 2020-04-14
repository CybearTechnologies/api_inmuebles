<?php
class DaoSeat extends Dao {
	private const QUERY_CREATE = "CALL insertSeat(:name,:rif,:location,:agency,:user,:dateCreated)";
	private const QUERY_GET_ALL = "CALL getAllSeats()";
	private const QUERY_GET_BY_ID = "CALL getSeatById(:id)";
	private const QUERY_UPDATE = "CALL updateSeat(:id,:name,:rif,:location,:agency,:user,:dateModified)";
	private const QUERY_GET_BY_NAME = "CALL getSeatByName(:name)";
	private const QUERY_GET_SEATS_BY_AGENCY = "CALL getSeatsByAgency(:id)";
	private const QUERY_DELETE = "CALL deleteSeat(:id,:user,:dateModified)";
	private const QUERY_ACTIVE = "CALL activeSeat(:id,:user,:dateModified)";
	private const QUERY_INACTIVE = "CALL inactiveSeat(:id,:user,:dateModified)";
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
			$user = 2; // TODO: replace for logged user
			$dateCreated = $this->_entity->getDateCreated();
			if ($this->_entity->getDateCreated() == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":rif", $rif, PDO::PARAM_STR);
			$stmt->bindParam(":location", $location, PDO::PARAM_INT);
			$stmt->bindParam(":agency", $agency, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
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
	 * @throws SeatNotFoundException
	 */
	public function updateSeat () {
		try {
			$id = $this->_entity->getId();
			$name = $this->_entity->getName();
			$rif = $this->_entity->getRif();
			$location = $this->_entity->getLocation();
			$agency = $this->_entity->getAgency();
			$user = 1; // TODO: replace for logged user
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_UPDATE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":rif", $rif, PDO::PARAM_STR);
			$stmt->bindParam(":location", $location, PDO::PARAM_INT);
			$stmt->bindParam(":agency", $agency, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new SeatNotFoundException("There are no seats found", 404);

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
	 * @throws SeatNotFoundException
	 */
	public function activeSeat () {
		try {
			$id = $this->_entity->getId();
			$userModifier = 1; /*TODO $this->_entity->getUserModifier();*/
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_ACTIVE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $userModifier, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new SeatNotFoundException("Agency not found", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Seat
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	public function inactiveSeat () {
		try {
			$id = $this->_entity->getId();
			$userModifier = 1; /* TODO $this->_entity->getUserModifier();*/
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_INACTIVE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $userModifier, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new SeatNotFoundException("Agency not found", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $id
	 *
	 * @return Seat[]
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	public function getAllSeatsByAgency ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_SEATS_BY_AGENCY);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new SeatNotFoundException("There are no seat found in this agency", 404);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $id
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
	 * @return Seat
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	public function getSeatByName () {
		try {
			$name = strtolower($this->_entity->getName());
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_NAME);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
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
	 * @throws SeatNotFoundException
	 */
	public function deleteSeat () {
		try {
			$id = $this->_entity->getId();
			$user = 1; // TODO: replace for logged user
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new SeatNotFoundException("There are no seats found", 404);

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