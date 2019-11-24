<?php
class GetAllRequestByUserIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetAllRequestByUserIdCommand constructor.
	 *
	 * @param $id
	 */
	public function __construct ($id) {
		$this->_id = $id;
		$this->_dao = FactoryDao::createDaoRequest();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllRequestByUserId($this->_id));
	}

	/**
	 * @return Request[]
	 */
	public function return () {
		return $this->getData();
	}
}