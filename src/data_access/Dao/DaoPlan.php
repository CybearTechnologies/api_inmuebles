<?php
class DaoPlan extends Dao {
	private const QUERY_CREATE = "CALL insertPlan(:name,:price,:user,:dateCreated);";
	private const QUERY_GET_ALL = "CALL getAllPlans()";
	private const QUERY_GET_BY_ID = "CALL getPlanById(:id)";
	private const QUERY_GET_BY_NAME = "CALL getPlanByName(:name)";
	private const QUERY_UPDATE = "CALL updatePlan(:id,:name,:price,:user,:dateModified)";
	private const QUERY_DELETE = "CALL deletePlan(:id,:user,:dateModified)";
	private const QUERY_ACTIVE = "CALL activePlan(:id,:user,:dateModified)";
	private const QUERY_INACTIVE = "CALL inactivePlan(:id,:user,:dateModified)";
	private $_entity;

	/**
	 * DaoPlan constructor.
	 *
	 * @param Plan $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}

	/**
	 * @return Plan
	 * @throws DatabaseConnectionException
	 */
	public function createPlan () {
		try {
			$name = $this->_entity->getName();
			$price = $this->_entity->getPrice();
			$user = 1; // TODO: replace for logged user
			$dateCreated = $this->_entity->getDateCreated();
			if ($dateCreated == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":price", $price, PDO::PARAM_STR);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
			$stmt->execute();

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Plan
	 * @throws DatabaseConnectionException
	 * @throws PlanNotFoundException
	 */
	public function getPlanByName () {
		try {
			$name = strtolower($this->_entity->getName());
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_NAME);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PlanNotFoundException("No plan found", 200);
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
	 * @return Plan
	 * @throws DatabaseConnectionException
	 * @throws PlanNotFoundException
	 */
	public function getPlanById (int $id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PlanNotFoundException("No plan found", 200);
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
	 * @return Plan[]
	 * @throws DatabaseConnectionException
	 * @throws PlanNotFoundException
	 */
	public function getAllPlans () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PlanNotFoundException("There are no plans found", 200);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Plan
	 * @throws DatabaseConnectionException
	 * @throws PlanNotFoundException
	 */
	public function updatePlanById () {
		try {
			$id = $this->_entity->getId();
			$name = $this->_entity->getName();
			$price = $this->_entity->getPrice();
			$user = 1; // TODO: replace for logged user
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_UPDATE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":price", $price, PDO::PARAM_STR);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PlanNotFoundException("There are no plans found", 200);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Plan
	 * @throws DatabaseConnectionException
	 * @throws PlanNotFoundException
	 */
	public function deletePlanById () {
		try {
			$id = $this->_entity->getId();
			$user = 1; // TODO: replace for logged user
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PlanNotFoundException("There are no plans found", 200);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Plan
	 * @throws DatabaseConnectionException
	 * @throws PlanNotFoundException
	 */
	public function activePlanById () {
		try {
			$id = $this->_entity->getId();
			$user = 1; // TODO: replace for logged user
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_ACTIVE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PlanNotFoundException("There are no plans found", 200);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Plan
	 * @throws DatabaseConnectionException
	 * @throws PlanNotFoundException
	 */
	public function inactivePlanById () {
		try {
			$id = $this->_entity->getId();
			$user = 1; // TODO: replace for logged user
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_INACTIVE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PlanNotFoundException("There are no plans found", 200);

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
	 * @return Plan
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createPlan($dbObject->id, $dbObject->name, $dbObject->price, $dbObject->userCreator,
			$dbObject->userModifier, $dbObject->dateCreated, $dbObject->dateModified, $dbObject->active,
			$dbObject->delete);
	}
}