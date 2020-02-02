<?php
class CommandGetPlanById extends Command {
	/**
	 * CommandGetPlanById constructor.
	 *
	 * @param Plan $plan
	 */
	public function __construct ($plan) {
		$this->_dao = FactoryDao::createDaoPlan($plan);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PlanNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getPlanById());
	}

	/**
	 * @return Plan
	 */
	public function return () {
		return $this->getData();
	}
}