<?php
class CommandGetSubscriptionById extends Command {
	private $_mapperSubs;
	private $_id;

	/**
	 * CommandGetSubscriptionById constructor.
	 */
	public function __construct ($id) {
		$this->_dao = FactoryDao::createDaoSubscription();
		$this->_mapperSubs = FactoryMapper::createMapperSubscription();
		$this->_id = $id;
	}

	/**
	 * @throws AgencyNotFoundException
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 * @throws MultipleUserException
	 * @throws SeatNotFoundException
	 * @throws SubscriptionNotFoundException
	 * @throws UserNotFoundException
	 * @throws PlanNotFoundException
	 */
	public function execute ():void {
		$subscription = $this->_dao->getSubscriptionById($this->_id);
		$dtoSubscription = $this->_mapperSubs->fromEntityToDto($this->_dao->getSubscriptionById($this->_id));
		//PLAN
		$command = FactoryCommand::createCommandGetPlanById(FactoryEntity::createPlan($dtoSubscription->plan));
		$command->execute();
		$dtoSubscription->plan = $command->return();
		//SEAT
		$command = FactoryCommand::createCommandGetSeatById(FactoryEntity::createSeat($dtoSubscription->seat));
		$command->execute();
		$dtoSubscription->seat = $command->return();
		//LOCATION
		$command = FactoryCommand::createCommandGetLocationById($subscription->getLocation());
		$command->execute();
		$dtoSubscription->location = $command->return();
		//SUB DETAIL
		$command = FactoryCommand::createCommandGetSubscriptionDetail($dtoSubscription->id); //TODO
		$command->execute();
		$dtoSubscription->subsDetails = $command->return();
		//USERCREATOR
		Tools::setUserToDto($dtoSubscription, $dtoSubscription->userCreator, $dtoSubscription->userModifier);
	}

	public function return () {
		// TODO: Implement return() method.
	}
}