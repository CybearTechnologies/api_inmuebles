<?php
class AgencyBuilder extends Builder {
	private $_mapper;
	private $_id;

	/**
	 * AgencyBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoAgency();
		$this->_mapper = FactoryMapper::createMapperAgency();
	}

	/**
	 * @param int $id
	 *
	 * @return AgencyBuilder
	 * @throws AgencyNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function getMinimumById (int $id) {
		$this->_data = $this->_mapper->fromEntityToDto($this->_dao->getAgencyById($id));
		$this->_id = $id;
		unset($this->_data->seats);

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function withSeats () {
		$listSeatBuilder = new ListSeatBuilder();

		$this->_data->seats = $listSeatBuilder
											->getMinimumById($this->_id)
											->clean()
											->build();

		return $this;
	}
}