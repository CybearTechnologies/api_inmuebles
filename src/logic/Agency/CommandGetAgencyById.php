<?php
class CommandGetAgencyById extends Command {
	/**
	 * CommandGetAgencyById constructor.
	 *
	 * @param Agency $agency
	 */
	public function __construct ($agency) {
		$this->_dao = FactoryDao::createDaoAgency($agency);
	}

	/**
	 * @throws AgencyNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAgencyById());
	}

	/**
	 * @return Agency
	 */
	public function return () {
		return $this->getData();
	}
}