<?php
class DaoExtra extends Dao {
	private const QUERY_CREATE = "CALL insertExtra(:name, :icon, :user,:dateCreated)";
	private const QUERY_GET_ALL = "CALL getAllExtras()";
	private const QUERY_GET_BY_STATE = "CALL getAllExtrasByState(:state)";
	private const QUERY_GET_BY_ID = "CALL getExtraById(:id)";
	private const QUERY_GET_EXTRA_BY_PROPERTY_ID = "CALL getAllExtrasByPropertyId(:id)";
	private const QUERY_DELETE_EXTRA_BY_ID = "CALL deleteExtraById(:id,:user,:dateModified)";
	private const QUERY_ACTIVE_EXTRA_BY_ID = "CALL activeExtraById(:id,:user,:dateModified)";
	private const QUERY_INACTIVE_EXTRA_BY_ID = "CALL inactiveExtraById(:id,:user,:dateModified)";
	private const QUERY_UPDATE = "CALL updateExtra(:id,:name,:icon,:user,:dateModified)";
	private $_entity;

	/**
	 * DaoExtra constructor.
	 *
	 * @param Extra $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}

	/**
	 * @param $name
	 * @param $icon
	 * @param $user
	 *
	 * @return Extra
	 * @throws DatabaseConnectionException
	 */
	public function createExtra ($name, $icon, $user) {
		try {
			$dateCreated = "";
			if ($dateCreated == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":icon", $icon, PDO::PARAM_STR);
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
	 * @return Extra[]
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function getAllExtraByState () {
		try {
			$state = $this->_entity->isActive();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_STATE);
			$stmt->bindParam(":state", $state, PDO::PARAM_INT);
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
	 * @param int $id
	 *
	 * @return Extra[]
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function getAllExtrasByPropertyId (int $id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_EXTRA_BY_PROPERTY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
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
	 * @param int $id
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
			else
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int $id
	 * @param int $user
	 *
	 * @throws DatabaseConnectionException
	 */
	public function deleteExtraById (int $id, int $user) {
		try {
			$dateModified = "";
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE_EXTRA_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int $id
	 * @param int $user
	 *
	 * @return Extra
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function inactiveExtraById ($id, $user) {
		try {
			$dateModified = "";
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_INACTIVE_EXTRA_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new ExtraNotFoundException("There are no Extra found", 404);
			else
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $id
	 * @param $user
	 *
	 * @return Extra
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function activeExtraById ($id, $user) {
		try {
			$dateModified = "";
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_ACTIVE_EXTRA_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new ExtraNotFoundException("There are no Extra found", 404);
			else
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param string $icon
	 * @param int    $user
	 *
	 * @return Extra
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function updateExtraById (int $id, string $name, string $icon, int $user) {
		try {
			$dateModified = "";
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_UPDATE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":icon", $icon, PDO::PARAM_STR);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new ExtraNotFoundException("Extra not found", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $dbObject
	 *
	 * @return Extra
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createExtra($dbObject->id, $dbObject->name, $dbObject->icon ?: "",
			$dbObject->userCreator, $dbObject->userModifier, $dbObject->dateCreated, $dbObject->dateModified,
			$dbObject->active, $dbObject->delete);
	}
}