<?php
class DaoRol extends Dao {
	private const QUERY_CREATE_ROL = "CALL insertRol(:name,:user,:dateCreated)";
	private const QUERY_GET_ALL = "CALL getAllRoles()";
	private const QUERY_GET_BY_ID = "CALL getRolById(:id)";
	private const QUERY_DELETE_BY_ID = "CALL deleteRolById(:id,:user,:dateModified)";
	private const QUERY_UPDATE = "CALL updateRol(:id,:name,:user,:dateModified)";
	private const QUERY_ACTIVE = "CALL activateRol(:id,:user,:dateModified)";
	private const QUERY_INACTIVE = "CALL inactiveRol(:id,:user,:dateModified)";
	private $_entity;

	/**
	 * DaoRol constructor.
	 *
	 * @param Rol $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}

	/**
	 * @param string $name
	 * @param int    $user
	 *
	 * @return Rol
	 * @throws DatabaseConnectionException
	 */
	public function createRol (string $name, $user) {
		try {
			$dateCreated = "";
			if ($dateCreated == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE_ROL);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
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
	 * @return Rol
	 * @throws DatabaseConnectionException
	 * @throws RolNotFoundException
	 */
	public function updateRol () {
		try {
			$id = $this->_entity->getId();
			$name = $this->_entity->getName();
			$userModifier = $this->_entity->getUserModifier();
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
				Throw new RolNotFoundException("Rol not found", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Rol
	 * @throws DatabaseConnectionException
	 * @throws RolNotFoundException
	 */
	public function activeRol () {
		try {
			$id = $this->_entity->getId();
			$userModifier = $this->_entity->getUserModifier();
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_ACTIVE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $userModifier, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RolNotFoundException("Rol not found", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Rol
	 * @throws DatabaseConnectionException
	 * @throws RolNotFoundException
	 */
	public function inactiveRol () {
		try {
			$id = $this->_entity->getId();
			$userModifier = $this->_entity->getUserModifier();
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_INACTIVE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $userModifier, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RolNotFoundException("Rol not found", 404);

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
	 * @return Rol
	 * @throws DatabaseConnectionException
	 * @throws RolNotFoundException
	 */
	public function getRolById (int $id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RolNotFoundException("Rol not found", 404);
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
	 * @throws RolNotFoundException
	 */
	public function deleteRolById () {
		try {
			$id = $this->_entity->getId();
			$user = $this->_entity->getUserModifier();
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RolNotFoundException("Rol not found", 404);
			else
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Rol[]
	 * @throws DatabaseConnectionException
	 * @throws RolNotFoundException
	 */
	public function getAllRol () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RolNotFoundException("There are no roles found", 404);
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
	 * @return mixed
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createRol($dbObject->id, $dbObject->name, $dbObject->userCreator, $dbObject->userModifier,
			$dbObject->dateCreated, $dbObject->dateModified, $dbObject->active, $dbObject->delete);
	}
}