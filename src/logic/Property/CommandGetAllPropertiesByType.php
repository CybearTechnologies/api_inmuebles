<?php
class CommandGetAllPropertiesByType extends Command {
	/**
	 * CommandGetAllPropertiesByType constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoProperty();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getPropertiesByType());
	}

	/**
	 * @return Property[]
	 */
	public function return () {
		return $this->getData();
	}
}