<?php
class GetAllSeatsCommand extends Command {

	/**
	 * GetAllSeatsCommand constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoSeat();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllSeats());
	}

	/**
	 * @return Seat[]
	 */
	public function return () {
		return $this->getData();
	}
}