<?php
class GetSeatByIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetSeatByIdCommand constructor.
	 *
	 * @param int $id
	 */
	public function __construct ($id) {
		$this->_dao = FactoryDao::createDaoSeat();
		$this->_id = $id;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getSeatById($this->_id));
	}

	/**
	 * @return Seat
	 */
	public function return () {
		return $this->getData();
	}
}