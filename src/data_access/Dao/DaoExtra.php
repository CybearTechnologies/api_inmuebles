<?php
class DaoExtra extends Dao {
	private const QUERY_CREATE = "CALL insertExtra(:name, :icon, :user,:dateCreated)";
	private const QUERY_GET_ALL = "CALL getAllExtras()";
	private const QUERY_GET_BY_ID = "CALL getExtraById(:id)";
	private const QUERY_GET_EXTRA_BY_PROPERTY_ID = "CALL getAllExtraByPropertyId(:id)";
	private const QUERY_DELETE_EXTRA_BY_ID = "CALL deleteExtraById(:id,:user)";
	private const QUERY_ACTIVE_EXTRA_BY_ID = "activeExtraById(:id,:user)";
	private const QUERY_INACTIVE_EXTRA_BY_ID = "inactiveExtraById(:id,:user)";
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
	 * @return Extra
	 * @throws DatabaseConnectionException
	 */
	public function createExtra () {
		try {
			$name = $this->_entity->getName();
			$icon = $this->_entity->getIcon();
			$user = 1; // TODO: replace for logged user
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$dateCreated = $this->_entity->getDateCreated();
			if ($dateCreated == "")
				$dateCreated = null;
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
	 * @return Extra
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function getExtraById () {
		try {
			$id = $this->_entity->getId();
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
	 * @return Extra
	 * @throws DatabaseConnectionException
	 */
	public function deleteExtraById () {
		try {
			$id = $this->_entity->getId();
			$user = 1; // TODO: replace for logged user
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE_EXTRA_BY_ID);
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
	 * @return Extra
	 * @throws DatabaseConnectionException
	 */
	public function inactiveExtraById () {
		try {
			$id = $this->_entity->getId();
			$user = 1; // TODO: replace for logged user
			$stmt = $this->getDatabase()->prepare(self::QUERY_INACTIVE_EXTRA_BY_ID);
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
	 * @return Extra
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function activeExtraById () {
		try {
			$id = $this->_entity->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_ACTIVE_EXTRA_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
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
	 * @return Extra[]
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function getAllPropertyExtra () {
		try {
			$id = $this->_entity->getId();
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