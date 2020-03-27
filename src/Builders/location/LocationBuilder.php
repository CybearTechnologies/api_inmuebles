<?php
class LocationBuilder extends Builder {
	private $_mapper;

	/**
	 * LocationBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoLocation();
		$this->_mapper = FactoryMapper::createMapperLocation();
	}

	/**
	 * @param int $id
	 *
	 * @return LocationBuilder
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 */
	public function getMinimumById (int $id) {
		$this->_data = $this->_mapper->fromEntityToDto($this->_dao->getLocationById($id));

		return $this;
	}
}