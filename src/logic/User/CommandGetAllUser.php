<?php
class CommandGetAllUser extends Command {
	/**
	 * CommandGetAllUser constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoUser();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllUser());
	}

	/**
	 * @return User[]
	 */
	public function return () {
		return $this->getData();
	}
}