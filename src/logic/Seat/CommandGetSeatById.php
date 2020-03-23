<?php
class CommandGetSeatById extends Command {
	private $_seatBuilder;
	private $_id;

	/**
	 * CommandGetSeatById constructor.
	 *
	 * @param int $seat
	 */
	public function __construct ($seat) {
		$this->_dao = FactoryDao::createDaoSeat($seat);
		$this->_seatBuilder = new SeatBuilder();
		$this->_id = $seat;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	public function execute ():void {
		$dtoSeat = $this->_seatBuilder->getMinimumById($this->_id)
										->withAgency()
										->clean()
										->build();
		$this->setData($dtoSeat);
	}

	/**
	 * @return Seat
	 */
	public function return () {
		return $this->getData();
	}
}