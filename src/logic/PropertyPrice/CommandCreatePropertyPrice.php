<?php
class CommandCreatePropertyPrice extends Command {
	/**
	 * CommandCreatePropertyPrice constructor.
	 *
	 * @param PropertyPrice $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoPropertyPrice($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->createPropertyPrice());
	}

	/**
	 * @return PropertyPrice
	 */
	public function return () {
		return $this->getData();
	}
}