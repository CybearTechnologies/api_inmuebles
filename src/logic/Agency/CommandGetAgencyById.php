<?php
class CommandGetAgencyById extends Command {
	private $_mapperAgency;
	private $_mapperSeat;
	private $_mapperUser;

	/**
	 * CommandGetAgencyById constructor.
	 *
	 * @param Agency $agency
	 */
	public function __construct ($agency) {
		$this->_dao = FactoryDao::createDaoAgency($agency);
		$this->_mapperAgency = FactoryMapper::createMapperAgency();
		$this->_mapperSeat = FactoryMapper::createMapperSeat();
		$this->_mapperUser = FactoryMapper::createMapperUser();
	}

	/**
	 * @throws AgencyNotFoundException
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$agency = $this->_dao->getAgencyById();
		$dtoAgency = $this->_mapperAgency->fromEntityToDto($agency);
		Tools::setUserToDto($dtoAgency, $agency->getUserCreator(),$agency->getUserModifier());
		$this->_dao = FactoryDao::createDaoSeat();
		try {
			$dtoSeats = $this->_mapperSeat->fromEntityArrayToDtoArray($this->_dao->getAllSeatsByAgency($dtoAgency->id));
			$dtoAgency->seats = $dtoSeats;
		}
		catch (SeatNotFoundException $e) {
			unset($dtoAgency->seats);
		}
		$this->setData($dtoAgency);
	}

	/**
	 * @param Dto $dto
	 * @param int $creator
	 * @param int $modifier
	 *
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws UserNotFoundException
	 */


	/**
	 * @return DtoAgency
	 */
	public function return () {
		return $this->getData();
	}
}