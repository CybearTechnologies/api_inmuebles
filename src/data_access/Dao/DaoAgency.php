<?php
class DaoAgency extends Dao {
	private const QUERY_CREATE = "";
	private const QUERY_GET_ALL = "SELECT plan_id id,plan_name name,plan_price price FROM plan";
	private const QUERY_GET_BY_ID = "SELECT plan_id id,plan_name name,plan_price price FROM plan WHERE plan_id = :id";

	/**
	 * DaoAgency constructor.
	 */
	public function __construct () {
		parent::__construct();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 * @throws DatabaseConnectionException
	 * @throws PropertyTypeNotFoundException
	 */
	public function getAgencyById ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyTypeNotFoundException("There are no Agency found", 200);
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
		return FactoryEntity::createAgency($dbObject->id, $dbObject->name);
	}

	/**
	 * @return Agency[]
	 * @throws DatabaseConnectionException
	 * @throws AgencyNotFoundException
	 */
	public function getAllAgency () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new AgencyNotFoundException("There are no agency found", 200);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $e) {
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}
}