<?php
class CommandGetAllProperty extends Command {
	/**
	 * CommandGetAllProperty constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoProperty();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllProperty());
	}

	/**
	 * @return mixed
	 */
	public function return () {
		return $this->getData();
	}
}