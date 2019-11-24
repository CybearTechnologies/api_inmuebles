<?php
class GetAllSeatsByAgencyID extends Command {
	private $_id;
	private $_dao;

	/**
	 * GetAllSeatsByAgencyID constructor.
	 *
	 * @param $_id
	 */
	public function __construct ($_id) {
		$this->_id = $_id;
		$this->_dao = FactoryDao::createDaoSeat();
	}

	public function execute ():void {
		$this->setData($this->_dao->getAllSeatsByAgencyID($this->_id));
	}

	public function return () {
		return $this->getData();
	}
}