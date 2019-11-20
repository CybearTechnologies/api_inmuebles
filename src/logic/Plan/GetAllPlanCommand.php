<?php
class GetAllPlanCommand extends Command {
	private $_dao;

	public function execute ():void {
		$this->_dao = FactoryDao::createDaoPlan();
		$this->setData($this->_dao->getAllPlans());
	}

	public function return () {
		return $this->getData();
	}
}