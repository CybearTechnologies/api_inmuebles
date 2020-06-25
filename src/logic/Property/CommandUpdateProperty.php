<?php
class CommandUpdateProperty extends Command {
	private $_id;
	private $_destiny;
	private $_name;
	private $_area;
	private $_description;
	private $_floor;
	private $_type;
	private $_location;
	private $_user;
	private $_dateModified;

	/**
	 * CommandUpdateProperty constructor.
	 *
	 * @param $_id
	 * @param $_destiny
	 * @param $_name
	 * @param $_area
	 * @param $_description
	 * @param $_floor
	 * @param $_type
	 * @param $_location
	 * @param $_user
	 * @param $_dateModified
	 */
	public function __construct ($_id, $_destiny, $_name, $_area, $_description, $_floor, $_type, $_location, $_user,
		$_dateModified) {
		$this->_id = $_id;
		$this->_destiny = $_destiny;
		$this->_name = $_name;
		$this->_area = $_area;
		$this->_description = $_description;
		$this->_floor = $_floor;
		$this->_type = $_type;
		$this->_location = $_location;
		$this->_user = $_user;
		$this->_dateModified = $_dateModified;
		$this->_dao = FactoryDao::createDaoProperty();
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->updateProperty($this->_id, $this->_destiny, $this->_name, $this->_area,
			$this->_description, $this->_floor, $this->_type, $this->_location, $this->_user, $this->_dateModified));
	}

	/***
	 * @return mixed
	 */
	public function return () {
		return $this->getData();
	}
}