<?php
class CommandAddSubscribeDetail extends Command {
	private $_subsDetail;
	private $_mapperSubscriptionDetail;
	/**
	 * CommandAddSubscribeDetail constructor.
	 *
	 * @param SubscriptionDetail[] $entity
	 */
	public function __construct ($entity) {
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
			array_push($_subsDetailResult,
				$this->_mapperSubscriptionDetail->fromEntityToDto($this->_dao->createSubscriptionDetail($subDetail)));
		}
		$this->setData($_subsDetailResult);
	}

	/**
	 * @return mixed
	 */
	public function return () {
		return $this->getData();
	}
}