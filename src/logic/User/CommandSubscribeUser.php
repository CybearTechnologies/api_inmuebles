<?php
class CommandSubscribeUser extends Command {
	private $_command;
	private $_subDetail;
	private $_mapperSubscription;
	private $_subscription;
	/**
	 * CommandSubscribeUser constructor.
	 *
	 * @param Subscription $subscription
	 * @param SubscriptionDetail[] $subDetail
	 */
	public function __construct ($subscription,$subDetail) {
		$this->_subscription = $subscription;
		$this->_dao = FactoryDao::createDaoSubscription();
		$this->_subDetail = $subDetail;
		$this->_mapperSubscription = FactoryMapper::createMapperSubscription();

	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$subscription= $this->_dao->createSubscription($this->_subscription);
		$dtoSubscription=$this->_mapperSubscription->fromEntityToDto($subscription);
		if(isset($this->_subDetail) && !empty($this->_subDetail)) {
			$this->_command = FactoryCommand::createCommandAddSubscribeDetail($this->_subDetail);
			$this->_command->execute();
			$dtoSubscription->subsDetails = $this->_command->return();
		}
		$this->setData($subscription);
	}

	/**
	 * @return DtoSubscription
	 */
	public function return () {
		return $this->getData();
	}
}