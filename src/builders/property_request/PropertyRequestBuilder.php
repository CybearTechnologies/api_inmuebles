<?php
class PropertyRequestBuilder extends Builder {
	private $_mapperRequest;

	/**
	 * PropertyRequestBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoRequest();
		$this->_mapperRequest = FactoryMapper::createMapperRequest();
	}

	/**
	 * @param int $id
	 *
	 * @return PropertyRequestBuilder
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function getMinimumById (int $id) {
		$this->_data = $this->_mapperRequest->fromEntityToDto($this->_dao->getRequestById($id));

		return $this;
	}
}