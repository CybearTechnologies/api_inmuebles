<?php
class CommandCreateSeat extends Command {
	private $_command;

	/**
	 * CommandCreateSeat constructor.
	 *
	 * @param Seat $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoSeat($entity);
		$this->_command = FactoryCommand::createCommandGetSeatByName($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws SeatAlreadyExistException
	 */
	public function execute ():void {
		try {
			$this->_command->execute();
			Throw new SeatAlreadyExistException("Seat already exist");
		}
		catch (SeatNotFoundException $e) {
			$this->setData($this->_dao->createSeat());
		}
	}

	/**
	 * @return Seat
	 */
	public function return () {
		return $this->getData();
	}
}