<?php
class DaoProperty extends Dao {
	private const QUERY_CREATE = "INSERT INTO property(pro_name,pro_area,pro_description,pro_publishdate,
	pro_status,pro_typefk,pro_userfk) VALUES (:name,:area,:description,:publishdate,:status,:type,:pro_userfk)";
	private const QUERY_GET_ALL = "SELECT pro_name name,pro_area area,pro_description description, pro_publishdate,
 	pro_status FROM property";
	private const QUERY_GET_BY_ID = "SELECT pro_name name,pro_area area,pro_description description, pro_publishdate,
 	pro_status FROM property WHERE pro_id = :pro_id";

	/**
	 * DaoProperty constructor.
	 */
	public function __construct () {
		parent::__construct();
	}

	/**
	 * @param Property $property
	 */
	public function createProperty ($property) {
		$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
		$stmt->bindParam(":name", $property->getName(), PDO::PARAM_STR);
		$stmt->bindParam(":description", $property->getDescription(), PDO::PARAM_STR);
		$stmt->bindParam(":area", $property->getArea(), PDO::PARAM_STR);
		$stmt->execute();
	}

	/**
	 * @param $dbObject
	 *
	 * @return mixed
	 */
	protected function extract ($dbObject) {
		// TODO: Implement extract() method.
	}
}