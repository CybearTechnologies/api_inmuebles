<?php
class CommandGetAllPlan extends Command {
	/**
	 * CommandGetAllPlan constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoPlan();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PlanNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllPlans());
	}

	/**
	 * @return Plan[]
	 */
	public function return () {
		return $this->getData();
	}
}