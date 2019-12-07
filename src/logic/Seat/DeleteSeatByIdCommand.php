<?php
class DeleteSeatByIdCommand extends Command {
	private $_dao;

	/**
	 * DeleteSeatByIdCommand constructor.
	 *
	 * @param Seat $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoSeat($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->deleteSeat());
	}

	/**
	 * @return Seat
	 */
	public function return () {
		return $this->getData();
	}
}