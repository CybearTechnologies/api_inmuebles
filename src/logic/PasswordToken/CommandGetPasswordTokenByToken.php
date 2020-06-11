<?php
class CommandGetPasswordTokenByToken extends Command {
	private $_mapper;
	private $_token;

	/**
	 * CommandGetPasswordTokenByToken constructor.
	 *
	 * @param String $token
	 */
	public function __construct (String $token) {
		$this->_dao = FactoryDao::createDaoPasswordToken();
		$this->_mapper = FactoryMapper::createMapperPasswordToken();
		$this->_token= $token;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PasswordTokenNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_mapper->fromEntityToDto(
			$this->_dao->getPasswordTokenByToken($this->_token)));
	}

	/**
	 * @return DtoPasswordToken
	 */
	public function return () {
		return $this->getData();
	}
}