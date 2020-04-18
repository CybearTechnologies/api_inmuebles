<?php
class CommandGetAllUser extends Command {
	private $_builder;

	/**
	 * CommandGetAllUser constructor.
	 */
	public function __construct () {
		$this->_builder = new ListUserBuilder();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$dtoUsers = $this->_builder
			->getAll()
			->withLocation()
			->withSeat()
			->withPlan()
			->withRol()
			->clean()
			->build();
		$this->setData($dtoUsers);
	}

	/**
	 * @return DtoUser[]
	 */
	public function return () {
		return $this->getData();
	}
}