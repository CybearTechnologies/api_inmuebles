<?php
class SeatBuilder extends Builder {
	private $_mapperSeat;

	/**
	 * SeatBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoSeat();
		$this->_mapperSeat = FactoryMapper::createMapperSeat();
	}

	/**
	 * @param int $id
	 *
	 * @return SeatBuilder
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	public function getMinimumById (int $id) {
		$this->_data = $this->_mapperSeat->fromEntityToDto($this->_dao->getSeatById($id));

		return $this;
	}

	/**
	 * @param int $id
	 *
	 * @return SeatBuilder
	 * @throws DatabaseConnectionException
	 */
	public function getAllSeatsByAgency (int $id) {
		try {
			$this->_array = $this->_mapperSeat->fromEntityArrayToDtoArray($this->_dao->getAllSeatsByAgency($id));
		}
		catch (SeatNotFoundException $e) {
			$this->_array = [];
		}

		return $this;
	}

	/**
	 * @return $this
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	public function withAgency () {
		$agencyBuilder = new AgencyBuilder();
		try {
			$this->_data->agency = $agencyBuilder->getMinimumById($this->_data->agency)
				->clean()
				->build();
		}
		catch (AgencyNotFoundException $e) {
			throw new SeatNotFoundException("Seat not found");
		}

		return $this;
	}
}