<?php
class CommandGetAllRequestByUserId extends Command {
	private $_userId;
	/**
	 * CommandGetAllRequestByUserId constructor.
	 *
	 * @param int $user
	 */
	public function __construct ($user) {
		$this->_dao = FactoryDao::createDaoRequest();
		$this->_userId = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllRequestByUserId($this->_userId));
	}

	/**
	 * @return Request[]
	 */
	public function return () {
		return $this->getData();
	}
}