<?php
class CommandCreatePasswordToken extends Command {
	private $_mapper;
	private $_passwordToken;
	private $_commandDeletePasswordToken;

	/**
	 * CommandCreatePasswordToken constructor.
	 *
	 * @param PasswordToken $passwordToken
	 * @param               $user
	 */
	public function __construct ($passwordToken,$user) {
		$this->_dao= FactoryDao::createDaoPasswordToken();
		$this->_passwordToken = $passwordToken;
		$this->_mapper = FactoryMapper::createMapperPasswordToken();
		$this->_commandDeletePasswordToken = FactoryCommand::createCommandDeletePasswordTokenByUserId($user);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PasswordTokenNotFoundException
	 */
	public function execute ():void {
			$this->_commandDeletePasswordToken->execute();
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