<?php
class CommandGetUserByUsername extends Command {
	private $_userBuilder;
	private $_username;

	/**
	 * CommandGetUserByUsername constructor.
	 *
	 * @param string $username
	 */
	public function __construct ($username) {
		$this->_dao = FactoryDao::createDaoUser();
		$this->_username = $username;
		$this->_userBuilder = new UserBuilder();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 * @throws MultipleUserException
	 */
	public function execute ():void {
		$dtoUser = $this->_userBuilder
										->getMinimumByUsername($this->_username)
										->withPlan()
										->withRol()
										->withSeat()
										->withLocation()
										->clean()
										->build();
		$this->setData($dtoUser);
	}

	/**
	 * @return DtoUser
	 */
	public function return () {
		return $this->getData();
	}
}