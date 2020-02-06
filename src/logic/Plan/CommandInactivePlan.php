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

	public function execute ():void {
		// TODO: Implement execute() method.
	}

	public function return () {
		// TODO: Implement return() method.
	}
}