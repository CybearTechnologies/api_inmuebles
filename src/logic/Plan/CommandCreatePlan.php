<?php
class CommandCreatePlan extends Command {
	private $_command;

	/**
	 * CretePlanCommand constructor.
	 *
	 * @param Plan $entity
	 */
	public function __construct ($entity) {
		$this->_command = FactoryCommand::createCommandGetPlanByName($entity);
		$this->_dao = FactoryDao::createDaoPlan($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PlanAlreadyExistException
	 */
	public function execute ():void {
		try {
			$this->_command->execute();
			Throw new PlanAlreadyExistException("Plan ya existente");
		}
		catch (PlanNotFoundException $exception) {
			$this->setData($this->_dao->createPlan());
		}
	}

	/**
	 * @return Plan
	 */
	public function return () {
		return $this->getData();
	}
}