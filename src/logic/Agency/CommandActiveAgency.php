<?php
class CommandActiveAgency extends Command {
	/**
	 * CommandActiveAgency constructor.
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
		$this->setData($this->_dao->activeAgency());
	}

	/**
	 * @return Agency
	 */
	public function return () {
		return $this->getData();
	}
}