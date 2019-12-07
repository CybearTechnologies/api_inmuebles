<?php
class DeleteAgencyByIdCommand extends Command {
	private $_dao;

	/**
	 * GetAgencyByIdCommand constructor.
	 *
	 * @param Agency $agency
	 */
	public function __construct ($agency) {
		$this->_dao = FactoryDao::createDaoAgency($agency);
	}

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