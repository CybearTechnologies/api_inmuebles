<?php
class InactivePropertyCommand extends Command {
	/**
	 * InactivePropertyCommand constructor.
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
		$this->setData($this->_dao->inactiveProperty());
	}

	/**
	 * @return mixed
	 */
	public function return () {
		return $this->getData();
	}
}