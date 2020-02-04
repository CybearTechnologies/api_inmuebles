<?php
class CommandGetAllRequestByUserId extends Command {
	/**
	 * CommandGetAllRequestByUserId constructor.
	 *
	 * @param User $user
	 */
	public function __construct ($user) {
		$this->_dao = FactoryDao::createDaoRequest($user);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllRequestByUserId());
	}

	/**
	 * @return Request[]
	 */
	public function return () {
		return $this->getData();
	}
}