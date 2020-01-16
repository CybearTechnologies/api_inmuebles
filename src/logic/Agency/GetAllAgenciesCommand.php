<?php
class GetAllAgenciesCommand extends Command {
	/**
	 * GetAllAgenciesCommand constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoAgency();
	}

	/**
	 * @throws AgencyNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllAgency());
	}

	/**
	 * @return Agency[]
	 */
	public function return () {
		return $this->getData();
	}
}