<?php
class CommandGetAllSubscription extends Command {
	/**
	 * CommandGetAllSubscription constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoSubscription();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws SubscriptionNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllSubscription());
	}

	/**
	 * @return Subscription[]
	 */
	public function return () {
		return $this->getData();
	}
}