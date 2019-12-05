<?php
class DaoPropertyType extends Dao {
	private const QUERY_CREATE = "CALL insertpropertytype(:name,:user)";
	private const QUERY_GET_ALL = "CALL getAllPropertyType()";
	private const QUERY_GET_BY_ID = "CALL getPropertyTypeById(:id)";
	private const QUERY_GET_BY_NAME = "CALL getPropertyTypeByName(:name)";
	private const QUERY_DELETE_PROPERTY_TYPE = "CALL deletePropertyTypeById(:id)";
	/**
	 * DaoPropertyType constructor.
	 */
	public function __construct () {
		parent::__construct();
	}

	/**
	 * @param $name
	 * @param $user
	 *
	 * @return PropertyType
	 * @throws DatabaseConnectionException
	 */
	public function createPropertyType ($name, $user) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":user", $user, PDO::PARAM_STR);
			$stmt->execute();

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
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
	public function getPropertyTypeById ($id) {
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
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database Connection problem.", 500);
		}
	}

	/**
	 * @param $id
	 *
	 * @return void
	 * @throws DatabaseConnectionException
	 */
	public function deletePropertyById ($id):void {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE_PROPERTY_TYPE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database Connection problem.", 500);
		}
	}

	/**
	 * @param $name
	 *
	 * @return PropertyType
	 * @throws DatabaseConnectionException
	 * @throws PropertyTypeNotFoundException
	 */
	public function getPropertyByName ($name) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_NAME);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyTypeNotFoundException("There are no property type called ,$name, found", 200);
			else {
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database Connection problem.", 500);
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
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $DBObject
	 *
	 * @return PropertyType
	 */
	protected function extract ($DBObject) {
		return FactoryEntity::createPropertyType($DBObject->id, $DBObject->name, $DBObject->active);
	}
}