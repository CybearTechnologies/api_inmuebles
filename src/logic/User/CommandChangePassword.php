<?php
class CommandChangePassword extends Command {
	private $_user;
	private $_password;

	/**
	 * CommandChangePassword constructor.
	 *
	 * @param $user
	 * @param $password
	 */
	public function __construct ($user, $password) {
		$this->_dao = FactoryDao::createDaoUser();
		$this->_user = $user;
		$this->_password = Validate::passwordHash($password . Environment::siteKey() . Tools::siteEncrypt($password));
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->changePassword($this->_user, $this->_password));
	}

	/**
	 * @return User
	 */
	public function return () {
		return $this->getData();
	}
}