<?php
class GetAllRequestByUserIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetAllRequestByUserIdCommand constructor.
	 */
	public function __construct ($_id) {
		$this->_id = $_id;
		$this->_dao = FactoryDao::createDaoRequest();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllRequestByUserId($this->_id));
	}

	public function return () {
		$this->getData();
	}
}