<?php
class GetAllAgenciesCommand extends Command {
	private $_dao;

	/**
	 * GetAllAgenciesCommand constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoAgency();
	}

	public function execute ():void {
		$this->setData($this->_dao->getAllAgency());
	}

	public function return () {
		return $this->getData();
	}
}