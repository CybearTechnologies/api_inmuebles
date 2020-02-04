<?php
class CommandGetUserById extends Command {
	/**
	 * CommandGetUserById constructor.
	 *
	 * @param User $user
	 */
	public function __construct ($user) {
		$this->_dao = FactoryDao::createDaoUser($user);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getUserById());
	}

	/**
	 * @return User
	 */
	public function return ():User {
		return $this->getData();
	}
}