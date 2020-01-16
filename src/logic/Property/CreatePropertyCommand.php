<?php
class CreatePropertyCommand extends Command {
	/**
	 * CreatePropertyCommand constructor.
	 *
	 * @param Property $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoProperty($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->createProperty());
	}

	/**
	 * @return Property
	 */
	public function return ():Property {
		return $this->getData();
	}
}