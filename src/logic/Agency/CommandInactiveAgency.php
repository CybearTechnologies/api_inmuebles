<?php
class CommandInactiveAgency extends Command {
	/**
	 * CommandInactiveAgency constructor.
	 *
	 * @param Agency $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoAgency($entity);
	}

	/**
	 * @throws AgencyNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->inactiveAgency());
	}

	/**
	 * @return Agency
	 */
	public function return () {
		return $this->getData();
	}
}