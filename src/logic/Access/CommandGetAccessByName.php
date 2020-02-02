<?php
class CommandGetAccessByName extends Command {
	/**
	 * CommandGetAccessByName constructor.
	 *
	 * @param Access $access
	 */
	public function __construct ($access) {
		$this->_dao = FactoryDao::createDaoAccess($access);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws AccessNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAccessByName());
	}

	/**
	 * @return Access
	 */
	public function return () {
		return $this->getData();
	}
}