<?php
class CommandInactiveProperty extends Command {
	private $_property;
	private $_user;

	/**
	 * CommandInactiveProperty constructor.
	 *
	 * @param int $property
	 * @param int $user
	 */
	public function __construct ($property, $user) {
		$this->_dao = FactoryDao::createDaoProperty();
		$this->_property = $property;
		$this->_user = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->inactiveProperty($this->_property, $this->_user));
	}

	/**
	 * @return mixed
	 */
	public function return () {
		return $this->getData();
	}
}