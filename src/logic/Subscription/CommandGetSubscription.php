<?php
class CommandGetSubscription extends Command {
	private $_builder;
	private $_id;

	/**
	 * CommandGetSubscription constructor.
	 *
	 * @param int $id
	 */
	public function __construct (int $id) {
		$this->_builder = new SubscriptionBuilder();
		$this->_id = $id;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws SubscriptionNotFoundException
	 */
	public function execute ():void {
		$dtoSubscription = $this->_builder->getMinimumById($this->_id)->withDetails()->andPlan()->andLocation()
																											->andSeat()
																											->clean()
																											->build();
		$this->setData($dtoSubscription);
	}

	/**
	 * @return DtoSubscription
	 */
	public function return () {
		return $this->getData();
	}
}