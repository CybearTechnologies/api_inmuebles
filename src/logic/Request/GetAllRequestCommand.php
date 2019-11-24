<?php
class GetAllRequestCommand extends Command {
	private $_dao;

	/**
	 * GetAllRequestCommand constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoRequest();
	}

	public function execute ():void {
		$this->setData($this->_dao->getAllRequest());
	}

	public function return () {
		$this->getData();
	}
}