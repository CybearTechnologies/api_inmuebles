<?php
class CommandGetAllSubscription extends Command {
	private $_builder;
	private $_id;

	/**
	 * CommandGetAllSubscription constructor.
	 */
	public function __construct () {
		$this->_builder = new ListSubscriptionBuilder();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws SubscriptionNotFoundException
	 */
	public function execute ():void {
		$dtoSubscriptions = $this->_builder->getAll()
													->withSeat()
													->andPlan()
													->andDetails()
													->andLocation()
													->andIdentity()
													->clean()
													->build();
		$this->setData($dtoSubscriptions);
	}

	/**
	 * @return Subscription[]
	 */
	public function return () {
		return $this->getData();
	}
}