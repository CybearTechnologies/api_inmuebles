<?php
class GetAllSeatCommand extends Command {
	private $_dao;

	/**
	 * GetAllSeatCommand constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoSeat();
	}

	public function execute ():void {
		$this->setData($this->_dao->getAllSeat());
	}

	public function return () {
		return $this->getData();
	}
}