<?php
class CommandDeletePasswordTokenByUserId extends Command {
	private $_mapper;
	private $_user;

	/**
	 * CommandCreatePasswordToken constructor.
	 *
	 * @param $user
	 */
	public function __construct ($user) {
		$this->_dao= FactoryDao::createDaoPasswordToken();
		$this->_user = $user;
		$this->_mapper = FactoryMapper::createMapperPasswordToken();
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->_dao->deletePasswordTokenById($this->_user);
	}

	public function return () {
	}
}