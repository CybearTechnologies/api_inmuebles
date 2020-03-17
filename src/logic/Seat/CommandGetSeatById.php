<?php
class CommandGetSeatById extends Command {
	private $_mapperSeat;
	private $_mapperLocation;
	private $_mapperAgency;

	/**
	 * CommandGetSeatById constructor.
	 *
	 * @param Seat $seat
	 */
	public function __construct ($seat) {
		$this->_dao = FactoryDao::createDaoSeat($seat);
		$this->_mapperSeat = FactoryMapper::createMapperSeat();
		$this->_mapperAgency = FactoryMapper::createMapperAgency();
		$this->_mapperLocation = FactoryMapper::createMapperLocation();
	}

	/**
	 * @throws AgencyNotFoundException
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 * @throws MultipleUserException
	 * @throws SeatNotFoundException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$seat = $this->_dao->getSeatById();
		$dtoSeat = $this->_mapperSeat->fromEntityToDto($seat);
		Tools::setUserToDto($dtoSeat, $dtoSeat->userCreator, $dtoSeat->userModifier);
		//AGENCY
		$command = FactoryCommand::createCommandGetAgencyById(FactoryEntity::createAgency($dtoSeat->agency));
		$command->execute();
		$dtoSeat->agency = $command->return();
		//LOCATION
		$command = FactoryCommand::createCommandGetLocationById(FactoryEntity::createLocation($seat->getLocation()));
		$command->execute();
		$dtoSeat->location = $command->return();
		//RETURN
		$this->setData($dtoSeat);
	}

	/**
	 * @return Seat
	 */
	public function return () {
		return $this->getData();
	}
}