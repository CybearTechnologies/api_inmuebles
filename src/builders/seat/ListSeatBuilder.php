<?php
class ListSeatBuilder extends ListBuilder {
	private $_mapperSeat;

	/**
	 * ListSeatBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoSeat();
		$this->_mapperSeat = FactoryMapper::createMapperSeat();
	}

	/**
	 * @param int $id
	 *
	 * @return ListSeatBuilder
	 * @throws DatabaseConnectionException
	 */
	function getMinimumById (int $id) {
		try {
			$this->_data = $this->_mapperSeat->fromEntityArrayToDtoArray($this->_dao->getAllSeatsByAgency($id));
		}
		catch (SeatNotFoundException $e) {
			$this->_data = [];
		}

		return $this;
	}

	/**
	 * @return listSeatBuilder
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	function getAll () {
		$this->_data = $this->_mapperSeat->fromEntityArrayToDtoArray($this->_dao->getAllSeats());

		return $this;
	}
}