<?php
class ListAgencyBuilder extends ListBuilder {
	private $_mapperAgency;

	/**
	 * ListAgencyBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoAgency();
		$this->_mapperAgency = FactoryMapper::createMapperAgency();
	}

	/**
	 * @inheritDoc
	 */
	function getMinimumById (int $id) {
		return $this;
	}

	/**
	 * @return ListAgencyBuilder
	 * @throws AgencyNotFoundException
	 * @throws DatabaseConnectionException
	 */
	function getAll () {
		$this->_data = $this->_mapperAgency->fromEntityArrayToDtoArray($this->_dao->getAllAgency());
		foreach ($this->_data as $datum) {
			unset($datum->seats);
		}

		return $this;
	}
}