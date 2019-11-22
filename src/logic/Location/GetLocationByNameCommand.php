<?php
class GetLocationByNameCommand extends Command {
	private $_dao;
	private $_name;

	/**
	 * GetLocationByNameCommand constructor.
	 *
	 * @param $_id
	 */
	public function __construct ($_name) {
		$this->_name = $_name;
	}

	public function execute ():void {
		$this->_dao = FactoryDao::createDaoLocation();
		$this->setData($this->_dao->getLocationByName($this->_name));
	}

	public function return () {
		return $this->getData();
	}
}
