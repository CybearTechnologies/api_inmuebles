<?php
class InactivePlanCommand extends Command {
	/**
	 * InactivePlanCommand constructor.
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