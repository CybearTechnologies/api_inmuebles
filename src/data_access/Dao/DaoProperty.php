<?php



class DaoProperty extends Dao {
	private const QUERY_CREATE = "call insertProperty(:name,:area,:description,:floor,:type,:location,
								  :user,:dateCreated)";
	private const QUERY_GET_ALL = "CALL getAllProperty()";
	private const QUERY_GET_BY_ID = "CALL getPropertyById(:id)";
	private const QUERY_DELETE_BY_ID = "CALL deletePropertyById(:id,:user)";
	private const QUERY_INACTIVE_PROPERTY_BY_ID = "inactivePropertyById(:id,:user)";
	private const QUERY_ACTIVE_PROPERTY_BY_ID = "activePropertyById(:id,:user)";
	private $_genericQuery = "SELECT pr.pr_id id, pr.pr_name 'name', pr.pr_area area, pr.pr_description description,
	 									   pr.pr_floor floor, pr.pr_status 'status', pr.pr_active active, pr.pr_type 'type', 
	 									   pr.pr_deleted 'delete', pr.pr_location location, 
	 									   pr.pr_user_created_fk userCreated, pr.pr_date_created dateCreated,
	 									   pr.pr_user_modified_fk userModified, pr.pr_date_modified dateModified,
	 									   (SELECT pp_price FROM property_price WHERE pp_property_fk = pr.pr_id 
	 									   ORDER BY pp_date_created DESC limit 1) lastPrice
	 									   FROM property pr  
	 									   :tables :sentences ;";
	private $_property;

	/**
	 * DaoProperty constructor.
	 *
	 * @param Property $property
	 */
	public function __construct ($property) {
		parent::__construct();
		$this->_property = $property;
	}

	/**
	 * @param $keyWord
	 * @param $extraList
	 * @param $minPrice
	 * @param $maxPrice
	 *
	 * @return string|string[]
	 */
	public function genericGetProperty($keyWord,$extraList,$minPrice,$maxPrice){
		$first=0;
		if((isset($keyWord))OR(isset($minPrice))OR(isset($maxPrice)) OR (isset($extraList) AND !(empty($extraList)))){
			$this->_genericQuery = str_replace(":sentences", "WHERE :sentences", $this->_genericQuery);
		}
		if(isset($minPrice) OR isset($maxPrice)) {
			if($first == 0)
				$first=1;
			else
				$this->_genericQuery = str_replace(":sentences", "AND :sentences", $this->_genericQuery);
			if(isset($minPrice))
				$this->_genericQuery = str_replace(":sentences", "lastPrice >=".$minPrice." AND :sentences", $this->_genericQuery);
			if(isset($maxPrice))
				$this->_genericQuery = str_replace(":sentences", "lastPrice =<".$maxPrice." :sentences", $this->_genericQuery);
		}
		if(isset($extraList) AND !(empty($extraList))){
			if($first == 0)
				$first=1;
			else
				$this->_genericQuery = str_replace(":sentences", "AND :sentences", $this->_genericQuery);
			$this->_genericQuery=str_replace(":tables",", property_extra pe, extra ex :tables",$this->_genericQuery);
			$this->_genericQuery=str_replace(":sentences","pe.pe_property_fk = pr.pr_id AND
			pe.pe_extra_dk = ex.ex_id AND( :sentences ",$this->_genericQuery);
			$size=sizeof($extraList);
			$i = 0;
			foreach ($extraList as $extra) {
				if($i==$size){
					$this->_genericQuery = str_replace(":sentences", " ex.ex_name =".$extra." ) :sentences", $this->_genericQuery);
				}
				else
					$this->_genericQuery = str_replace(":sentences", " ex.ex_name =".$extra." OR :sentences", $this->_genericQuery);
				$i++;
			}
			$this->_genericQuery = str_replace(" OR :sentences", ")", $this->_genericQuery);
		}
		$this->_genericQuery=str_replace(":tables","",$this->_genericQuery);
		return $this->_genericQuery;
	}

	/**
	 * @return Property
	 * @throws DatabaseConnectionException
	 */
	public function createProperty () {
		try {
			$name = $this->_property->getName();
			$description = $this->_property->getDescription();
			$area = $this->_property->getArea();
			$floor = $this->_property->getFloor();
			$type = $this->_property->getType();
			$dateCreated = $this->_property->getDateCreated();
			if ($this->_property->getDateCreated() == "")
				$dateCreated = null;
			$location = $this->_property->getLocation();
			$user = $this->_property->getUserCreator();
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":description", $description, PDO::PARAM_STR);
			$stmt->bindParam(":area", $area, PDO::PARAM_STR);
			$stmt->bindParam(":floor", $floor, PDO::PARAM_INT);
			$stmt->bindParam(":type", $type, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":location", $location, PDO::PARAM_INT);
			$stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
			$stmt->execute();

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Property[]
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function getAllProperty () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyNotFoundException("There are no property found", 404);
			else {
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Property
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function getPropertyById () {
		try {
			$id = $this->_property->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyNotFoundException("There are no property found", 404);
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
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function deletePropertyByPropertyId () {
		try {
			$id = $this->_property->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyNotFoundException("There are no property found", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Property
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function inactiveProperty () {
		try {
			$id = $this->_property->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_INACTIVE_PROPERTY_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyNotFoundException("There are no property found", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Property
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function activeProperty () {
		try {
			$id = $this->_property->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_ACTIVE_PROPERTY_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyNotFoundException("There are no property found", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $dbObject
	 *
	 * @return Property
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createProperty($dbObject->id, $dbObject->name,
			$dbObject->area, $dbObject->description, $dbObject->status, $dbObject->floor, $dbObject->type,
			$dbObject->location, $dbObject->active, $dbObject->delete, $dbObject->userCreator, $dbObject->userModifier,
			$dbObject->dateCreated, $dbObject->dateModified);
	}
}