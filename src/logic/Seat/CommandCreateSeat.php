<?php
class CommandCreateSeat extends Command {
	private $_dao;

	/**
	 * CommandCreateSeat constructor.
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
		$this->setData($this->_dao->createSeat());
	}

	/**
	 * @return Seat
	 */
	public function return () {
		return $this->getData();
	}
}