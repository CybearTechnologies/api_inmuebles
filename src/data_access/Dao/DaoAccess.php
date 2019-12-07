<?php
class DaoAccess extends Dao {
	private const QUERY_CREATE_AGENCY = "";
	private const QUERY_GET_ALL = "CALL getAllAccess()";
	private const QUERY_GET_BY_ID = "";
	private $_entity;

	/**
	 * DaoAccess constructor.
	 *
	 * @param Access $_entity
	 */
	public function __construct ($_entity) {
		parent::__construct();
		$this->_entity = $_entity;
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
			$dbObject->dateCreated, $dbObject->dateModified);
	}
}