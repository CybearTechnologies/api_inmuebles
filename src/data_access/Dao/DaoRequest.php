<?php
class DaoRequest extends Dao {
	private const QUERY_CREATE = "CALL insertRequest(:property,:user)"; //TODO
	private const QUERY_GET_ALL = "CALL getAllRequest()";
	private const QUERY_GET_BY_ID = "CALL getRequestById(:id)";
	private const QUERY_GET_BY_USER_ID = "CALL getAllRequestByUserId(:id)";
	private const QUERY_GET_REQUEST_BY_PROPERTY_ID = "CALL getAllRequestByProperty(:id)";
	private $_entity;

	/**
	 * DaoRequest constructor.
	 *
	 * @param Request|Property|User $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}

	/**
	 * @return Request[]
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function getAllRequestByPropertyId () {
		try {
			$id = $this->_entity->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_REQUEST_BY_PROPERTY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RequestNotFoundException("There are no request found", 200);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Request[]
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function getAllRequest () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RequestNotFoundException("There are no request found", 200);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Request[]
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function getAllRequestByUserId () {
		try {
			$id = $this->_entity->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_USER_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RequestNotFoundException("There are no request found", 200);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Request
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function getRequestById () {
		try {
			$id = $this->_entity->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RequestNotFoundException("There are no request found", 200);
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
	 * @param $dbObject
	 *
	 * @return Request
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createRequest($dbObject->id, $dbObject->active,$dbObject->delete,$dbObject->userCreator,
			$dbObject->userModifier,$dbObject->dateCreated,$dbObject->dateModified);
	}
}