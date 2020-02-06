<?php
class CommandUpdatePlan extends Command {
	/**
	 * CommandUpdatePlan constructor.
	 *
	 * @param Plan $plan
	 */
	public function __construct ($plan) {
		$this->_dao = FactoryDao::createDaoPlan($plan);
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->updatePlanById());
	}

	/**
	 * @return Plan
	 */
	public function return ():Plan {
		return $this->getData();
	}
}