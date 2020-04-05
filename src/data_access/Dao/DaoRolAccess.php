<?php
class DaoRolAccess extends Dao {
	private const QUERY_INSERT = "CALL insertAccessRol(:rol,:access,:user,:dateCreated)";
	private const QUERY_GET_ACCESS_BY_ROL = "CALL getAccessByRol(:rol)";
	private const QUERY_DEACTIVATE = "CALL deactivateRolAccessById(:rol,:access,:user,:dateModified)";
	private const QUERY_ACTIVATE = "CALL activateRolAccessById(:rol,:access,:user,:dateModified)";
	private $_entity;

	/**
	 * DaoRolAccess constructor.
	 *
	 * @param RolAccess $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}

	/**
	 * @return RolAccess
	 * @throws DatabaseConnectionException
	 */
	public function createRolAccess () {
		try {
			$rol = $this->_entity->getRol();
			$access = $this->_entity->getAccess();
			$user = 1; // TODO: replace for logged user
			$dateCreated = $this->_entity->getDateCreated();
			if ($dateCreated == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_INSERT);
			$stmt->bindParam(":rol", $rol, PDO::PARAM_INT);
			$stmt->bindParam(":access", $access, PDO::PARAM_INT);
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
	 * @return RolAccess[]
	 * @throws DatabaseConnectionException
	 * @throws RolAccessNotFoundException
	 */
	public function getAccessByRol () {
		try {
			$rol = $this->_entity->getRol();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ACCESS_BY_ROL);
			$stmt->bindParam(":rol", $rol, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RolAccessNotFoundException("There are no access with this rol ['{$rol}'] found", 404);
			else {
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int $rol
	 * @param int $accss
	 *
	 * @return RolAccess
	 * @throws DatabaseConnectionException
	 * @throws RolAccessNotFoundException
	 */
	public function activateRolAccessById (int $rol, int $accss) {
		try {
			$user = 1; //TODO change dis user for user log
			$dateModified = "";
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_ACTIVATE);
			$stmt->bindParam(":rol", $rol, PDO::PARAM_INT);
			$stmt->bindParam(":access", $accss, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RolAccessNotFoundException("There are no access found", 404);
			else
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int $rol
	 * @param int $access
	 *
	 * @return RolAccess
	 * @throws DatabaseConnectionException
	 * @throws RolAccessNotFoundException
	 */
	public function deactivateRolAccessById (int $rol, int $access) {
		try {
			$user = 1; //TODO change dis user for user log
			$dateModified = "";
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_DEACTIVATE);
			$stmt->bindParam(":rol", $rol, PDO::PARAM_INT);
			$stmt->bindParam(":access", $access, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RolAccessNotFoundException("There are no access found", 404);
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
	 * @return RolAccess
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createRolAccess(
			$dbObject->id, $dbObject->rol,
			$dbObject->access,
			$dbObject->userCreator, $dbObject->userModifier,
			$dbObject->dateCreated, $dbObject->dateModified,
			$dbObject->active, $dbObject->delete);
	}
}