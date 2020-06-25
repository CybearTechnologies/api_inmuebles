<?php
class CommandGetPasswordTokenByToken extends Command {
	private $_mapper;
	private $_token;
	private $_user;

	/**
	 * CommandGetPasswordTokenByToken constructor.
	 *
	 * @param String $token
	 * @param String $user
	 */
	public function __construct (String $token,String $user) {
		$this->_dao = FactoryDao::createDaoPasswordToken();
		$this->_mapper = FactoryMapper::createMapperPasswordToken();
		$this->_token= $token;
		$this->_user=$user;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PasswordTokenNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_mapper->fromEntityToDto(
			$this->_dao->getPasswordTokenByToken($this->_token,$this->_user)));
	}

	/**
	 * @return DtoPasswordToken
	 */
	public function return () {
		return $this->getData();
	}
}