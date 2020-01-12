<?php
class DaoExtra extends Dao {
	private const QUERY_CREATE = "CALL insertExtra(:name,:user)"; //TODO
	private const QUERY_GET_ALL = "CALL getAllExtras()";
	private const QUERY_GET_BY_ID = "CALL getExtraById(:id)";
	private const QUERY_GET_EXTRA_BY_PROPERTY_ID = "CALL getAllExtraByPropertyID(:id)";
	private $_entity;

	/**
	 * DaoExtra constructor.
	 *
	 * @param Extra|Property $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
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
		return FactoryEntity::createExtra($dbObject->id, $dbObject->name);
	}
}