<?php
class DaoPropertyType extends Dao {
	private const QUERY_CREATE = "CALL insertPropertyType(:name, :image, :user);";
	private const QUERY_GET_ALL = "CALL getAllPropertyType()";
	private const QUERY_GET_BY_ID = "CALL getPropertyTypeById(:id)";
	private const QUERY_GET_BY_NAME = "CALL getPropertyTypeByName(:name)";
	private const QUERY_DELETE_PROPERTY_TYPE = "CALL deletePropertyTypeById(:id,:user)";
	private $_propertyType;

	/**
	 * DaoPropertyType constructor.
	 *
	 * @param PropertyType $propertyType
	 */
	public function __construct ($propertyType) {
		parent::__construct();
		$this->_propertyType = $propertyType;
	}

	/**
	 * @return PropertyType
	 * @throws DatabaseConnectionException
	 */
	public function createPropertyType () {
		try {
			$name = $this->_propertyType->getName();
			$image = $this->_propertyType->getImage();
			$user = $this->_propertyType->getUserCreator();
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":image", $image, PDO::PARAM_STR);
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
	 * @return PropertyType[]
	 * @throws DatabaseConnectionException
	 * @throws PropertyTypeNotFoundException
	 */
	public function getAllPropertyTypes () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyTypeNotFoundException("There are no property type found", 404);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int $id
	 *
	 * @return PropertyType
	 * @throws DatabaseConnectionException
	 * @throws PropertyTypeNotFoundException
	 */
	public function getPropertyTypeById (int $id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyTypeNotFoundException("There are no property type found", 404);
			else
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database Connection problem.", 500);
		}
	}

	/**
	 * @return PropertyType
	 * @throws DatabaseConnectionException
	 * @throws PropertyTypeNotFoundException
	 */
	public function getPropertyByName () {
		try {
			$name = strtolower($this->_propertyType->getName());
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_NAME);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyTypeNotFoundException("There are no property type called ,$name, found", 404);
			else
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database Connection problem.", 500);
		}
	}

	/**
	 * @return PropertyType
	 * @throws DatabaseConnectionException
	 */
	public function deletePropertyById ():PropertyType {
		try {
			$id = $this->_propertyType->getId();
			$user = 1; // TODO: replace for logged user
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE_PROPERTY_TYPE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->execute();

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database Connection problem.", 500);
		}
	}

	/**
	 * @param $DBObject
	 *
	 * @return PropertyType
	 */
	protected function extract ($DBObject) {
		return FactoryEntity::createPropertyType($DBObject->id, $DBObject->name, $DBObject->image,
			$DBObject->userCreator, $DBObject->userModifier, $DBObject->dateCreated, $DBObject->dateModified,
			$DBObject->active, $DBObject->delete);
	}
}