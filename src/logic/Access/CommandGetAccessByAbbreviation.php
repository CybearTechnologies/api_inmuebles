<?php
class CommandGetAccessByAbbreviation extends Command {
	/**
	 * CommandGetAccessByAbbreviation constructor.
	 *
	 * @param Access $access
	 */
	public function __construct ($access) {
		$this->_dao = FactoryDao::createDaoAccess($access);
	}

	/**
	 * @throws AccessNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAccessByAbbreviation());
	}

	/**
	 * @return Access
	 */
	public function return () {
		return $this->getData();
	}
}