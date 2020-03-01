<?php
class CommandGetAllUserPropertiesByState extends Command {
	/**
	 * CommandGetAllUserPropertiesByState constructor.
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
		$this->setData($this->_dao->getPropertiesByUserAndState());
	}

	/**
	 * @return Property[]
	 */
	public function return () {
		return $this->getData();
	}
}