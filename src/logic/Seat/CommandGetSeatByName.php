<?php
class CommandGetSeatByName extends Command {
	/**
	 * CommandGetSeatByName constructor.
	 *
	 * @param Seat $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoSeat($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws SeatNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getSeatByName());
	}

	/**
	 * @return Seat
	 */
	public function return () {
		return $this->getData();
	}
}