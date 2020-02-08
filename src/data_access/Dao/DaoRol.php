<?php
class DaoRol extends Dao {
	private const QUERY_CREATE_ROL = "CALL insertRol(:name,:user,:dateCreated)";
	private const QUERY_GET_ALL = "CALL getAllRol()";
	private const QUERY_GET_BY_ID = "CALL getRolById(:id)";
	private const QUERY_DELETE_BY_ID = "CALL deleteRolById(:id)";
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
	 * @throws DatabaseConnectionException
	 */
	public function createRol () {
		try {
			$id = $this->_entity->getName();
			$user = 1; //TODO change for logged user
			$dateCreated = $this->_entity->getDateCreated();
			if ($dateCreated == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE_ROL);
			$stmt->bindParam(":name", $id, PDO::PARAM_INT);
			$stmt->bindParam(":userCreator", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateCreated", $user, PDO::PARAM_STR);
			$stmt->execute();
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
	public function getRolById () {
		try {
			$id = $this->_entity->getId();
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
	 */
	public function deleteRolById () {
		try {
			$id = $this->_entity->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
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