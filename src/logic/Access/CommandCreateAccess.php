<?php
class CommandCreateAccess extends Command {
	private $_name;
	private $_abbreviation;
	private $_user;

	/**
	 * CommandCreateAccess constructor.
	 *
	 * @param $name
	 * @param $abbreviation
	 * @param $loggedUser
	 */
	public function __construct ($name, $abbreviation, $loggedUser) {
		$this->_dao = FactoryDao::createDaoAccess();
		$this->_name = $name;
		$this->_abbreviation = $abbreviation;
		$this->_user = $loggedUser;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->createAccess($this->_name,$this->_abbreviation,$this->_user));
	}

	/**
	 * @return Access
	 */
	public function return ():Access {
		return $this->getData();
	}
}