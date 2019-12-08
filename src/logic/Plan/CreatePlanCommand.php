<?php
class CreatePlanCommand extends Command {
	private $_dao;

	/**
	 * CretePlanCommand constructor.
	 *
	 * @param Plan $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoPlan($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->createPlan());
	}

	/**
	 * @return Plan
	 */
	public function return () {
		return $this->getData();
	}
}