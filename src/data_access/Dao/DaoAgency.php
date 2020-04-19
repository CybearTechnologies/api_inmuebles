<?php
class DaoAgency extends Dao {
	private const QUERY_CREATE_AGENCY = "CALL insertAgency(:name,:user,:dateCreated)";
	private const QUERY_GET_ALL = "CALL getAllAgencies()";
	private const QUERY_GET_BY_ID = "CALL getAgencyById(:id)";
	private const QUERY_DELETE_BY_ID = "CALL deleteAgency(:id,:user,:dateModified)";
	private const QUERY_GET_BY_NAME = "CALL getAgencyByName(:name)";
	private const QUERY_UPDATE = "CALL updateAgency(:id,:name,:user,:dateModified)";
	private const QUERY_ACTIVE = "CALL activeAgency(:id,:user,:dateModified)";
	private const QUERY_INACTIVE = "CALL inactiveAgency(:id,:user,:dateModified)";
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
			$user = 1; // TODO: replace for logged user
			$name = $this->_entity->getName();
			$dateCreated = $this->_entity->getDateCreated();
			if ($dateCreated == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE_AGENCY);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(':user', $user, PDO::PARAM_INT);
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
	 * @return Agency
	 * @throws DatabaseConnectionException
	 * @throws AgencyNotFoundException
	 */
	public function updateAgency () {
		try {
			$id = $this->_entity->getId();
			$name = $this->_entity->getName();
			$userModifier = 1; /*TODO $this->_entity->getUserModifier();*/
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_UPDATE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":user", $userModifier, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new AgencyNotFoundException("Agency not found", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Agency
	 * @throws DatabaseConnectionException
	 * @throws AgencyNotFoundException
	 */
	public function activeAgency () {
		try {
			$id = $this->_entity->getId();
			$userModifier = 1; /*$this->_entity->getUserModifier();*/
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_ACTIVE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $userModifier, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new AgencyNotFoundException("Agency not found", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Agency
	 * @throws DatabaseConnectionException
	 * @throws AgencyNotFoundException
	 */
	public function inactiveAgency () {
		try {
			$id = $this->_entity->getId();
			$userModifier = 1; /*$this->_entity->getUserModifier();*/
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_INACTIVE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $userModifier, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new AgencyNotFoundException("Agency not found", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new DatabaseConnectionException("Database connection problem.", 500);
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
	 * @param $id
	 *
	 * @return Agency
	 * @throws AgencyNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function getAgencyById ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new AgencyNotFoundException("Agency not found", 404);
			else
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
	 * @throws DatabaseConnectionException
	 * @throws AgencyNotFoundException
	 */
	public function deleteAgencyById () {
		try {
			$id = $this->_entity->getId();
			$user = 1; // TODO: replace for logged user
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new AgencyNotFoundException("There are no Agency found", 404);

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
		return FactoryEntity::createAgency($dbObject->id, $dbObject->name, $dbObject->icon,$dbObject->userCreator,
			$dbObject->userModifier, $dbObject->dateCreated, $dbObject->dateModified, $dbObject->active,
			$dbObject->delete);
	}
}
