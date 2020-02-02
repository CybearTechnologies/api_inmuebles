<?php
class DaoAgency extends Dao {
	private const QUERY_CREATE_AGENCY = "CALL insertAgency(:name,:user)";
	private const QUERY_GET_ALL = "CALL getAllAgencies()";
	private const QUERY_GET_BY_ID = "CALL getAgencyById(:id)";
	private const QUERY_DELETE_BY_ID = "CALL deleteAgency(:id,:user)";
	private const QUERY_GET_BY_NAME = "CALL getAgencyByName(:name)";
	private $_entity;

	/**
	 * DaoAgency constructor.
	 *
	 * @param Agency $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}

	/**
	 * @return Agency
	 * @throws DatabaseConnectionException
	 */
	public function createAgency () {
		try {
			$id = $this->_entity->getName();
			$user = $this->_entity->getUserCreator();
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE_AGENCY);
			$stmt->bindParam(":name", $id, PDO::PARAM_STR);
			$stmt->bindParam(':user', $user, PDO::PARAM_INT);
			$stmt->execute();

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Agency
	 * @throws DatabaseConnectionException
	 * @throws AgencyNotFoundException
	 */
	public function getAgencyById () {
		try {
			$id = $this->_entity->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new AgencyNotFoundException("There are no Agencies found", 404);
			else
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Agency[]
	 * @throws DatabaseConnectionException
	 * @throws AgencyNotFoundException
	 */
	public function getAllAgency () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new AgencyNotFoundException("There are no Agency found", 404);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function deleteAgencyById () {
		try {
			$id = $this->_entity->getId();
			$user = $this->_entity->getUserModifier();
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE_BY_ID);
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
	 * @return Agency
	 * @throws AgencyNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function getAgencyByName () {
		try {
			$name = strtolower($this->_entity->getName());
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_NAME);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new AgencyNotFoundException("There are no Agencies found", 404);
			else
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $dbObject
	 *
	 * @return Agency
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createAgency($dbObject->id, $dbObject->name, $dbObject->userCreator,
			$dbObject->userModifier, $dbObject->dateCreated, $dbObject->active, $dbObject->delete);
	}
}
