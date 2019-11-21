<?php
class GetAgenciesByIdWithSeatCommand extends Command {
	private $_commands = [];
	private $_idAgency;
	private $_agency;
	private $_seats;

	/**
	 * GetAgenciesByIdWithSeatCommand constructor.
	 *
	 * @param $_idAgency
	 */
	public function __construct ($_idAgency) {
		$this->_idAgency = $_idAgency;
		$this->init();
	}

	public function init () {
		$this->_agency = FactoryEntity::createAgency($this->_idAgency);
		$this->_seats = FactoryEntity::createSeat();
		array_push($this->_commands, FactoryCommand::createGetAgenciesById($this->_idAgency));
		array_push($this->_commands, FactoryCommand::createGetAllSeatsByAgencyID($this->_idAgency));
	}

	public function execute ():void {
		foreach ($this->_commands as $command) {
			$command->execute();
		}
		$this->build();
	}

	public function build () {
		$this->_agency = $this->_commands[0]->return();
		$this->_seats = $this->_commands[1]->return();
		$this->_agency->setSeats($this->_seats);
		$this->setData($this->_agency);
	}

	public function return () {
		return $this->getData();
	}
}