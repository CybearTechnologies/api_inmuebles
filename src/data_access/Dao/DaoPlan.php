<?php
class DaoPlan extends Dao {
	private const QUERY_CREATE = "CALL insertPlan(:name,:price,:active,:user)";
	private const QUERY_GET_ALL = "CALL getAllPlans()";
	private const QUERY_GET_BY_ID = "CALL getPlanById(:id)";
	private const QUERY_DELETE_BY_ID = "CALL deletePlan(:id)";
	private $_plan;

	/**
	 * DaoPlan constructor.
	 *
	 * @param Plan $plan
	 */
	public function __construct ($plan) {
		parent::__construct();
		$this->_plan = $plan;
	}

	/**
	 * @return Plan
	 * @throws DatabaseConnectionException
	 * @throws PlanNotFoundException
	 */
	public function getPlanById () {
		try {
			$id = $this->_plan->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PlanNotFoundException("No plan found", 200);
			else {
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $e) {
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
		catch (PDOException $e) {
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $dbObject
	 *
	 * @return Plan
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createPlan($dbObject->id, $dbObject->name, $dbObject->price, $dbObject->active);
	}
}