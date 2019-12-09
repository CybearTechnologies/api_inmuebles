<?php
class GetAgencyByNameCommand extends Command {
	/**
	 * GetAgencyByNameCommand constructor.
	 *
	 * @param Agency $agency
	 */
	public function __construct (Agency $agency) {
		$this->_dao = FactoryDao::createDaoAgency($agency);
	}

	/**
	 * @throws AgencyNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAgencyByName());
	}

	/**
	 * @return Agency
	 */
	public function return ():Agency {
		return $this->getData();
	}
}