<?php
class CommandGetAllUserProperties extends Command {
	/**
	 * CommandGetAllUserProperties constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoProperty();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getPropertiesByUser());
	}

	/**
	 * @return Property[]
	 */
	public function return () {
		return $this->getData();
	}
}