<?php
class DaoPlan extends Dao {
	private const QUERY_CREATE = "";
	private const QUERY_GET_ALL = "CALL getAllPlans()";
	private const QUERY_GET_BY_ID = "CALL getPlanById(:id)";

	/**
	 * DaoPlan constructor.
	 */
	public function __construct () {
		parent::__construct();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 * @throws DatabaseConnectionException
	 * @throws PlanNotFoundException
	 */
	public function getPlanById ($id) {
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
		catch (PDOException $e) {
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $dbObject
	 *
	 * @return mixed
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createPlan($dbObject->id, $dbObject->name, $dbObject->price, $dbObject->active);
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
}