<?php
class CreateAgencyCommand extends Command {
	private $_dao;

	/**
	 * CreateAgencyCommand constructor.
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
	public function return ():Agency {
		return $this->getData();
	}
}