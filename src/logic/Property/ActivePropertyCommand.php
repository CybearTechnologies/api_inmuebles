<?php
class ActivePropertyCommand extends Command {
	/**
	 * ActivePropertyCommand constructor.
	 *
	 * @param PropertyPrice $entity
	 */
	public function __construct (PropertyPrice $entity) {
		$this->_dao = FactoryDao::createDaoProperty($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->activeProperty());
	}

	/***
	 * @return mixed
	 */
	public function return () {
		return $this->getData();
	}
}