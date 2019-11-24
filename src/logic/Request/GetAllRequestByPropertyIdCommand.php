<?php
class GetAllRequestByPropertyIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetAllRequestByPropertyIdCommand constructor.
	 *
	 * @param $_id
	 */
	public function __construct (int $_id) {
		$this->_id = $_id;
		$this->_dao = FactoryDao::createDaoRequest();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllRequestByPropertyId($this->_id));
	}

	public function return () {
		$this->getData();
	}
}