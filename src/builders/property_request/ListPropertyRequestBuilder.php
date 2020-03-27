<?php
class ListPropertyRequestBuilder extends ListBuilder {
	private $_mapperRequest;

	/**
	 * ListPropertyRequestBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoRequest();
		$this->_mapperRequest = FactoryMapper::createMapperRequest();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function getAll () {
		$this->_data = $this->_mapperRequest->fromEntityArrayToDtoArray($this->_dao->getAllRequest());

		return $this;
	}

	/**
	 * @param int $id
	 *
	 * @return ListPropertyRequestBuilder
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function getMinimumById (int $id) {
		$this->_data = $this->_mapperRequest->fromEntityArrayToDtoArray($this->_dao->getAllRequestByPropertyId($id));
		foreach ($this->_data as $item) {
			unset($item->property);
		}
		return $this;
	}
}