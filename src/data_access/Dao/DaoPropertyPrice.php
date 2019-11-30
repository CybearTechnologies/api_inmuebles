<?php
class DaoPropertyPrice extends Dao {
	private const QUERY_CREATE = "";
	private const QUERY_GET_ALL = "";
	private const QUERY_GET_BY_ID = "";
	private const QUERY_GET_BY_PROPERTY_ID = "CALL getAllPricesByProperty(:id)";

	/**
	 * DaoPropertyPrice constructor.
	 */
	public function __construct () {
		parent::__construct();
	}

	/**
	 * @param $id
	 *
	 * @return PropertyPrice[]
	 * @throws DatabaseConnectionException
	 * @throws InvalidPropertyPriceException
	 */
	public function getPriceByPropertyId ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_PROPERTY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new InvalidPropertyPriceException("There are no price for this property found", 200);
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
	 * @return PropertyPrice
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createPropertyPrice($dbObject->id, $dbObject->price, $dbObject->date, $dbObject->final);
	}
}