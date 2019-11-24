<?php
class GetAllRequestCommand extends Command {
	private $_dao;

	/**
	 * GetAllRequestCommand constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoRequest();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllRequest());
	}

	/**
	 * @return Request[]
	 */
	public function return () {
		return $this->getData();
	}
}