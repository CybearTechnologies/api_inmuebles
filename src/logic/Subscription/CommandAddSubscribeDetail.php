<?php
class CommandAddSubscribeDetail extends Command {
	private $_subscription;
	private $_subsDetail;
	private $_mapperSubscriptionDetail;

	/**
	 * CommandAddSubscribeDetail constructor.
	 *
	 * @param Subscription         $subscription
	 * @param SubscriptionDetail[] $entity
	 */
	public function __construct ($subscription, $entity) {
		$this->_subscription = $subscription;
		$this->_subsDetail = $entity;
		$this->_dao = FactoryDao::createDaoSubscriptionDetail();
		$this->_mapperSubscriptionDetail = FactoryMapper::createMapperSubscriptionDetail();
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$_subsDetailResult = [];
		foreach ($this->_subsDetail as $subDetail) {
			$subDetail->setSubscription($this->_subscription->getId());
			array_push($_subsDetailResult,
				$this->_mapperSubscriptionDetail->fromEntityToDto($this->_dao->createSubscriptionDetail($subDetail)));
		}
		$this->setData($_subsDetailResult);
	}

	/**
	 * @return SubscriptionDetail[]
	 */
	public function return () {
		return $this->getData();
	}
}