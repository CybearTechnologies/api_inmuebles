<?php

class CommandInactiveUser extends Command {
	/**
	 * CommandInactiveUser constructor.
	 *
	 * @param $user
	 */
	public function __construct ($user) {
		$this->_dao = FactoryDao::createDaoUser($user);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->inactiveUser());
	}

	/**
	 * @return User
	 */
	public function return () {
		return $this->getData();
	}
}