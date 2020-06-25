<?php
class CommandGetUserById extends Command {
	private $_userBuilder;
	private $_id;

	/**
	 * CommandGetUserById constructor.
	 *
	 * @param int $id
	 */
	public function __construct ($id) {
		$this->_userBuilder = new UserBuilder();
		$this->_id = $id;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$dtoUser = $this->_userBuilder->getMinimumById($this->_id)
																	->withRol()
																	->withPlan()
																	->withLocation()
																	->withSeat()
																	->withIdentity()
																	->clean()
																	->build();
		$this->setData($dtoUser);
	}

	/**
	 * @return DtoUser
	 */
	public function return ():DtoUser {
		return $this->getData();
	}
}