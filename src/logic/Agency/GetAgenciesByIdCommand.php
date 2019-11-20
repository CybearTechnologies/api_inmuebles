<?php
class GetAgenciesByIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetAgenciesByIdCommand constructor.
	 *
	 * @param $_id
	 */
	public function __construct ($_id) {
		$this->_id = $_id;
	}

	public function execute ():void {
		$this->_dao = FactoryDao::createDaoAgency();
		$this->setData($this->_dao->getAgencyById($this->_id));
	}

	public function return () {
		return $this->getData();
	}
}