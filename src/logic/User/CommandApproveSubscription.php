<?php
class CommandApproveSubscription extends Command {
	private $_mapperSubscription;
	private $_subscription;
	/**
	 * CommandApproveSubscription constructor.
	 *
	 * @param Subscription $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoSubscription();
		$this->_mapperSubscription = FactoryMapper::createMapperSubscription();
		$this->_subscription = $entity;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$result= $this->_dao->approveSubscription($this->_subscription->getId(),$this->_subscription->getUserModifier(),
			$this->_subscription->getDateModified());
		$this->setData($this->_mapperSubscription->fromEntityToDto($result));
	}

	/**
	 * @return DtoSubscription
	 */
	public function return () {
		return $this->getData();
	}
}