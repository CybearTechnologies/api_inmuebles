<?php
class CommandDeleteSubscription extends Command {
	private $_id;
	private $_mapperSubscription;
	/**
	 * CommandDeleteSubscription constructor.
	 *
	 * @param int $entity
	 */
	public function __construct ($entity) {
		$this->_dao= FactoryDao::createDaoSubscription();
		$this->_mapperSubscription = FactoryMapper::createMapperSubscription();
		$this->_id = $entity;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws SubscriptionNotFoundException
	 */
	public function execute ():void {
		$result = $this->_mapperSubscription->fromEntityToDto($this->_dao->deleteSubscription($this->_id));
		$this->setData($result);
	}

	/**
	 * @return DtoSubscription
	 */
	public function return () {
		return $this->getData();
	}
}