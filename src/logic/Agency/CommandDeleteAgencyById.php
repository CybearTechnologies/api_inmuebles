<?php
class CommandDeleteAgencyById extends Command {
	/**
	 * CommandDeleteAgencyById constructor.
	 *
	 * @param Agency $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoAgency($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws AgencyNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->deleteAgencyById());
	}

	/**
	 * @return Agency
	 */
	public function return () {
		return $this->getData();
	}
}