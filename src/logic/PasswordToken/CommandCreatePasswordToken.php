<?php
class CommandCreatePasswordToken extends Command {
	private $_mapper;
	private $_passwordToken;
	/**
	 * CommandCreatePasswordToken constructor.
	 *
	 * @param PasswordToken $passwordToken
	 */
	public function __construct ($passwordToken) {
		$this->_dao= FactoryDao::createDaoPasswordToken();
		$this->_passwordToken = $passwordToken;
		$this->_mapper = FactoryMapper::createMapperPasswordToken();
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
			$this->setData($this->_mapper->fromEntityToDto($this->_dao->createPasswordToken($this->_passwordToken->getToken(),
				$this->_passwordToken->getUserCreator(),
				"")));
	}

	/**
	 * @return DtoPasswordToken
	 */
	public function return () {
		return $this->getData();
	}

}