<?php
class GetAllRequestByPropertyIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetAllRequestByPropertyIdCommand constructor.
	 *
	 * @param $id
	 */
	public function __construct (int $id) {
		$this->_id = $id;
		$this->_dao = FactoryDao::createDaoRequest();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllRequestByPropertyId($this->_id));
	}

	/**
	 * @return Request[]
	 */
	public function return () {
		return $this->getData();
	}
}