<?php
class CreateAgencyCommand extends Command {
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
		$this->setData($this->_dao->createAgency());
	}

	/**
	 * @return Agency
	 */
	public function return () {
		return $this->getData();
	}
}