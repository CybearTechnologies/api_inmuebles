<?php
class GetAllSeatsByAgencyCommand extends Command {
	private $_dao;

	/**
	 * GetAllSeatsByAgencyCommand constructor.
	 *
	 * @param Agency $agency
	 */
	public function __construct ($agency) {
		$this->_dao = FactoryDao::createDaoSeat($agency);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllSeatsByAgency());
	}

	/**
	 * @return Seat[]
	 */
	public function return () {
		return $this->getData();
	}
}