<?php
class GetAllPlanCommand extends Command {
	private $_dao;

	/**
	 * GetAllPlanCommand constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoPlan();
	}

	public function execute ():void {
		$this->setData($this->_dao->getAllPlans());
	}

	public function return () {
		return $this->getData();
	}
}