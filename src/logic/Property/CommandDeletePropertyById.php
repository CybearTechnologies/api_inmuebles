<?php
class CommandDeletePropertyById extends Command {
	/**
	 * CommandDeletePropertyById constructor.
	 *
	 * @param Property $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoProperty($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->deletePropertyByPropertyId());
	}

	/**
	 * @return Property
	 */
	public function return ():Property {
		return $this->getData();
	}
}