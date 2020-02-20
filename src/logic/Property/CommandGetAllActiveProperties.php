<?php
class CommandGetAllActiveProperties extends Command {
	/**
	 * CommandGetAllActiveProperties constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoProperty();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllActiveProperties());
	}

	/**
	 * @return Property[]
	 */
	public function return () {
		return $this->getData();
	}
}