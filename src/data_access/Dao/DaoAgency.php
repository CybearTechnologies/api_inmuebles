<?php
class DaoAgency extends Dao {
	private const QUERY_GET_ALL = "SELECT ag_id id,ag_name name FROM agency";
	private const QUERY_GET_BY_ID = "SELECT ag_id id,ag_name name FROM agency WHERE ag_id = :id";

	/**
	 * DaoAgency constructor.
	 */
	public function __construct () {
		parent::__construct();
	}

	/**
	 * @param int $id
	 *
	 * @return Agency
	 * @throws DatabaseConnectionException
	 * @throws AgencyNotFoundException
	 */
	public function getAgencyById ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new AgencyNotFoundException("There are no Agencies found", 404);
			else
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
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
				Throw new AgencyNotFoundException("There are no Agency found", 404);
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
	 * @return Agency
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createAgency($dbObject->id, $dbObject->name);
	}
}