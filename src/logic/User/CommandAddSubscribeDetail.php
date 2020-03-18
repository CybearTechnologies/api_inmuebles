<?php
class CommandAddSubscribeDetail extends Command {
	private $_subsDetail;
	/**
	 * CommandAddSubscribeDetail constructor.
	 *
	 * @param SubscriptionDetail[] $entity
	 */
	public function __construct ($entity) {
		$this->_subsDetail=$entity;
		$this->_dao= FactoryDao::createDaoSubscriptionDetail();
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->createSubscriptionDetail($this->_subsDetail[0]));
	}

	/**
	 * @return mixed
	 */
	public function return () {
		return $this->getData();
	}
}