<?php
class CommandGetAllSeatsByAgency extends Command {
	private $_id;
	private $_seatBuilder;

	/**
	 * CommandGetAllSeatsByAgency constructor.
	 *
	 * @param int $id
	 */
	public function __construct ($id) {
		$this->_dao = FactoryDao::createDaoSeat();
		$this->_seatBuilder = new ListSeatBuilder();
		$this->_id = $id;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$dtoSeat = $this->_seatBuilder->getMinimumById($this->_id)
																	->clean()
																	->build();
		$this->setData($dtoSeat);
	}

	/**
	 * @return DtoSeat[]
	 */
	public function return () {
		return $this->getData();
	}
}