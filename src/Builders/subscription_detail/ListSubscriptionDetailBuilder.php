<?php
class ListSubscriptionDetailBuilder extends ListBuilder {
	private $_mapper;

	/**
	 * ListSubscriptionDetailBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoSubscriptionDetail();
		$this->_mapper = FactoryMapper::createMapperSubscriptionDetail();
	}

	/**
	 * @param int $id
	 *
	 * @return ListSubscriptionDetailBuilder
	 * @throws DatabaseConnectionException
	 * @throws SubscriptionDetailNotFoundException
	 */
	function getMinimumById (int $id) {
		$this->_data = $this->_mapper->fromEntityArrayToDtoArray($this->_dao->getSubscriptionDetailBySubscription($id));

		return $this;
	}

	/**
	 * @return ListSubscriptionDetailBuilder
	 */
	function getAll () {
		return $this;
	}
}