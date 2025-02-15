<?php
class DaoAccess extends Dao {
	private const QUERY_CREATE_ACCESS = "CALL insertAccess(:name,:abbreviation,:user,:dateCreated)";
	private const QUERY_GET_ALL = "CALL getAllAccess()";
	private const QUERY_GET_BY_ID = "CALL getAccessByid(:id)";
	private const QUERY_DELETE_BY_ID = "CALL deleteAccessById(:id,:user)";
	private const QUERY_GET_BY_NAME = "CALL getAccessByName(:name)";
	private const QUERY_GET_BY_ABBREVIATION = "CALL getAccessByAbbreviation(:abbreviation)";
	private const QUERY_GET_BY_ROL = "CALL getAccessByRol(:id)";
	private $_entity;

	/**
	 * DaoAccess constructor.
	 *
	 * @param Access $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}

	/**
	 * @param string $name
	 * @param string $abbreviation
	 * @param int    $user
	 *
	 * @return Access
	 * @throws DatabaseConnectionException
	 */
	public function createAccess ($name, $abbreviation, $user) {
		try {
			$dateCreated = ""; //TODO current date
			if ($dateCreated == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE_ACCESS);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":abbreviation", $abbreviation, PDO::PARAM_STR);
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
	 * @return Access
	 * @throws AccessNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function getAccessByAbbreviation () {
		try {
			$abbreviation = strtolower($this->_entity->getAbbreviation());
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ABBREVIATION);
			$stmt->bindParam(":abbreviation", $abbreviation, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new AccessNotFoundException("There are no acces with this '{$abbreviation}' found", 404);
			else {
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Access
	 * @throws AccessNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function getAccessByName () {
		try {
			$name = strtolower($this->_entity->getName());
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_NAME);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new AccessNotFoundException("There are no acces called '{$name}' found", 404);
			else {
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int $id
	 *
	 * @return Access
	 * @throws AccessNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function getAccessById ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new AccessNotFoundException("There are no access found", 404);
			else {
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $id
	 *
	 * @return Access[]
	 * @throws AccessNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function getAccessByRol ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ROL);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new AccessNotFoundException("There are no access found", 404);
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
	 * @param $id
	 * @param $user
	 *
	 * @return Access
	 * @throws AccessNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function deleteAccessById (int $id, int $user) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new AccessNotFoundException("There are no access found", 404);
			else
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Access[]
	 * @throws DatabaseConnectionException
	 * @throws AccessNotFoundException
	 */
	public function getAllAccess () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new AccessNotFoundException("There are no Accesses stored.");
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
	 * @return Access
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createAccess($dbObject->id, $dbObject->name, $dbObject->abbreviation,
			$dbObject->userCreator, $dbObject->userModifier, $dbObject->dateCreated, $dbObject->dateModified,
			$dbObject->active, $dbObject->delete);
	}
}