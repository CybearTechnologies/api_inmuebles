<?php
class GetLocationByIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetLocationByIdCommand constructor.
	 *
	 * @param $_id
	 */
	public function __construct ($_id) {
		$this->_id = $_id;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 */
	public function execute ():void {
		$this->_dao = FactoryDao::createDaoLocation();
		$this->setData($this->_dao->getLocationById($this->_id));
	}

	/**
	 * @return Location
	 */
	public function return () {
		return $this->getData();
	}
}
