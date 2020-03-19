<?php
class CommandGetPlanById extends Command {
	private $_mapperPlan;

	/**
	 * CommandGetPlanById constructor.
	 *
	 * @param Plan $plan
	 */
	public function __construct ($plan) {
		$this->_dao = FactoryDao::createDaoPlan($plan);
		$this->_mapperPlan = FactoryMapper::createMapperPlan();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws PlanNotFoundException
	 */
	public function execute ():void {
		$plan = $this->_dao->getPlanById();
		$dtoPlan = $this->_mapperPlan->fromEntityToDto($plan);
		try {
			Tools::setUserToDto($dtoPlan, $dtoPlan->userCreator, $dtoPlan->userModifier);
		}
		catch (UserNotFoundException $e) {
			$dtoPlan = FactoryDto::createDtoUser(0);
		}
		$this->setData($dtoPlan);
	}

	/**
	 * @return DtoPlan
	 */
	public function return () {
		return $this->getData();
	}
}