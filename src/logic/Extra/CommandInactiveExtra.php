<?php
class CommandInactiveExtra extends Command {
	/**
	 * CommandActiveExtra constructor.
	 *
	 * @param Extra $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoExtra($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->inactiveExtraById());
	}

	/***
	 * @return mixed
	 */
	public function return () {
		return $this->getData();
	}
}