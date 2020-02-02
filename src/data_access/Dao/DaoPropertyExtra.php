<?php
class DaoPropertyExtra extends Dao {
	private const QUERY_CREATE = "CALL insertPropertyExtra(:value,:property,:user);";
	private const QUERY_GET_BY_ID = "CALL getPropertyExtraById(:id)";
	private $_entity;

	/**
	 * DaoPropertyExtra constructor.
	 *
	 * @param PropertyExtra $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}

	/**
	 * @return PropertyExtra
	 * @throws DatabaseConnectionException
	 */
	public function createPropertyExtra () {
		try {
			$amount = $this->_entity->getAmount();
			$propertyId = $this->_entity->getPropertyId();
			$user = $this->_entity->getUserCreator();
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":value", $amount, PDO::PARAM_INT);
			$stmt->bindParam(":property", $propertyId, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->execute();

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return PropertyExtra
	 * @throws DatabaseConnectionException
	 * @throws PropertyExtraNotFoundException
	 */
	public function getPropertyExtraById () {
		try {
			$id = $this->_entity->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyExtraNotFoundException("Property Extra Not found", 200);
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
	 * @return PropertyExtra
	 */
	protected function extract ($dbObject) {
		/*return FactoryEntity::createExtra($dbObject->id, $dbObject->name,
			is_null($dbObject->icon) ? "" : $dbObject->icon, $dbObject->active,
			$dbObject->delete, $dbObject->userCreator, $dbObject->userModifier,
			$dbObject->dateCreated, $dbObject->dateModified);*/
	}
}