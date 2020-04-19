<?php
class SubscriptionDetailBuilder extends Builder {
	private $_mapper;

	/**
	 * SubscriptionDetailBuilder constructor.
	 */
	public function __construct () {
		$this->_mapper = FactoryMapper::createMapperSubscriptionDetail();
		$this->_dao = FactoryDao::createDaoSubscriptionDetail();
	}

	/**
	 * @param int $id
	 *
	 * @return SubscriptionDetailBuilder
	 * @throws DatabaseConnectionException
	 * @throws SubscriptionDetailNotFoundException
	 */
	public function getMinimumById (int $id) {
		$this->_data = $this->_mapper->fromEntityToDto($this->_dao->getSubscriptionDetailById($id));

		return $this;
	}
}