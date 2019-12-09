<?php
class GetPlanByNameCommand extends Command {
	/**
	 * GetPlanByNameCommand constructor.
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
		$this->setData($this->_dao->getPlanByName());
	}

	/**
	 * @return Plan
	 */
	public function return ():Plan {
		return $this->getData();
	}
}