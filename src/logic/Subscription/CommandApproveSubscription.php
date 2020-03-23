<?php
class CommandApproveSubscription extends Command {
	private $_mapperSubscription;
	private $_subscription;

	/**
	 * CommandApproveSubscription constructor.
	 *
	 * @param int $entity
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
		$dtoSubscription = $this->_mapperSubscription->fromEntityToDto($this->_dao->approveSubscription($this->_subscription));
		$this->setData($dtoSubscription);
	}

	/**
	 * @return DtoSubscription
	 */
	public function return () {
		return $this->getData();
	}
}