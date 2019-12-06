<?php
class GetSeatByIdCommand extends Command {
	private $_dao;

	/**
	 * GetSeatByIdCommand constructor.
	 *
	 * @param Seat $seat
	 */
	public function __construct ($seat) {
		$this->_dao = FactoryDao::createDaoSeat($seat);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getSeatById());
	}

	/**
	 * @return Seat
	 */
	public function return () {
		return $this->getData();
	}
}