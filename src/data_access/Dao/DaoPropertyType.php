<?php
class DaoPropertyType extends Dao {
	private const QUERY_CREATE = "INSERT INTO pro_type(pt_name) VALUES (:name);";
	private const QUERY_GET_ALL = "SELECT pt_id id, pt_name name FROM pro_type";
	private const QUERY_GET_BY_ID = "SELECT pt_id id, pt_name name FROM pro_type WHERE pt_id=:id";

	/**
	 * DaoPropertyType constructor.
	 */
	public function __construct () {
		parent::__construct();
	}

	/**
	 * @param $name
	 *
	 * @throws DatabaseConnectionException
	 */
	public function createPropertyType ($name) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->execute();
		}
		catch (PDOException $e) {
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $id
	 *
	 * @return PropertyType
	 * @throws DatabaseConnectionException
	 * @throws PropertyTypeNotFoundException
	 */
	public function getPropertyById ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyTypeNotFoundException("There are no property type found", 200);
			else {
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $e) {
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return PropertyType[]
	 * @throws DatabaseConnectionException
	 * @throws PropertyTypeNotFoundException
	 */
	public function getAllPropertyTypes () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyTypeNotFoundException("There are no property type found", 200);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $e) {
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $DBObject
	 *
	 * @return PropertyType
	 */
	protected function extract ($DBObject) {
		return FactoryEntity::createPropertyType($DBObject->id, $DBObject->name);
	}
}