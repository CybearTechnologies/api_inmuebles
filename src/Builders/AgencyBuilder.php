<?php
class AgencyBuilder extends Builder {
	private $_mapper;

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
		unset($this->_data->seats);

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function withSeats () {
		$this->_dao = FactoryDao::createDaoSeat();
		$this->_mapper = FactoryMapper::createMapperSeat();
		try {
			$this->_data->seats = $this->_mapper->fromEntityArrayToDtoArray($this->_dao->getAllSeatsByAgency($this->_data->id));
		}
		catch (SeatNotFoundException $e) {
			$this->_data->seats = [];
		}

		return $this;
	}
}