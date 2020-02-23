<?php
class CommandGetAllUserProperties extends Command {
	/**
	 * CommandGetAllUserProperties constructor.
	 *
	 * @param Property $entity
	 */
	public function __construct (Property $entity) {
		$this->_dao = FactoryDao::createDaoProperty($entity);
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