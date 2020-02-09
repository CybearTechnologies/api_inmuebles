<?php
class CommandInactivePlan extends Command {
	/**
	 * CommandInactivePlan constructor.
	 *
	 * @param Plan $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoPlan($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PlanNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->inactivePlanById());
	}

	/**
	 * @return Plan
	 */
	public function return () {
		return $this->getData();
	}
}