<?php
class ListLocationBuilder extends ListBuilder {
	private $_mapper;

	/**
	 * ListLocationBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoLocation();
		$this->_mapper = FactoryMapper::createMapperLocation();
	}

	/**
	 * @inheritDoc
	 */
	function getMinimumById (int $id) {
		return $this;
	}

	/**
	 * @param int $id
	 *
	 * @return $this
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 */
	function getByStateId (int $id) {
		$this->_data = $this->_mapper->fromEntityArrayToDtoArray($this->_dao->getLocationByState($id));

		return $this;
	}

	/**
	 * @param $id
	 * TODO
	 *
	 * @return $this
	 */
	function getByMunicipalityId ($id) {
		return $this;
	}

	/**
	 * TODO
	 */
	function getAll () {
		//$this->_data = $this->_mapper->fromEntityArrayToDtoArray($this->_dao->getAllLocations());
		return $this;
	}
}