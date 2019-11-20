<?php
class GetAllAgenciesCommand extends Command {
	private $_dao;

	public function execute ():void {
		$this->_dao = FactoryDao::createDaoAgency();
		$this->setData($this->_dao->getAllAgency());
	}

	public function return () {
		return $this->getData();
	}
}