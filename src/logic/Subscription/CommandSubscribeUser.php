<?php
class CommandSubscribeUser extends Command {
	private $_command;
	private $_subDetail;
	private $_mapperSubscription;
	private $_mapperSubdetail;
	private $_subscription;

	/**
	 * CommandSubscribeUser constructor.
	 *
	 * @param Subscription            $subscription
	 * @param DtoSubscriptionDetail[] $subDetail
	 */
	public function __construct ($subscription, $subDetail) {
		$this->_subscription = $subscription;
		$this->_dao = FactoryDao::createDaoSubscription();
		$this->_mapperSubscription = FactoryMapper::createMapperSubscription();
		$this->_mapperSubdetail = FactoryMapper::createMapperSubscriptionDetail();
		$this->_subDetail = $subDetail;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$subscription = $this->_dao->createSubscription($this->_subscription);
		$dtoSubscription = $this->_mapperSubscription->fromEntityToDto($subscription);

		$this->_subDetail = $this->_mapperSubdetail->fromDtoArrayToEntityArray($this->_subDetail);

		if (!empty($this->_subDetail)) {
			$this->_command = FactoryCommand::createCommandAddSubscribeDetail($subscription, $this->_subDetail);
			$this->_command->execute();
			array_push($dtoSubscription->subsDetails, $this->_command->return());
		}
		$this->setData($dtoSubscription);
	}

	/**
	 * @return DtoSubscription
	 */
	public function return () {
		return $this->getData();
	}
}