<?php
class GetLocationsByTypeCommand extends Command {
	private $_dao;
	private $_type;

	/**
	 * GetLocationsByTypeCommand constructor.
	 *
	 * @param $_id
	 */
	public function __construct ($_type) {
		$this->_type = $_type;
	}

	public function execute ():void {
		$this->_dao = FactoryDao::createDaoLocation();
		$this->setData($this->_dao->getLocationByType($this->_type));
	}

	public function return () {
		return $this->getData();
	}
}