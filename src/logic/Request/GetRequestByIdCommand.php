<?php
class GetRequestByIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetRequestByIdCommand constructor.
	 */
	public function __construct ($_id) {
		$this->_id = $_id;
		$this->_dao = FactoryDao::createDaoRequest();
	}

	public function execute ():void {
		$this->setData($this->_dao->getRequestById($this->_id));
	}

	public function return () {
		$this->getData();
	}
}