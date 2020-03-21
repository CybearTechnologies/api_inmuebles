<?php
class CommandGetPropertyById extends Command {
	private $_mapperProperty;
	private $_property;

	/**
	 * CommandGetPropertyById constructor.
	 *
	 * @param int $property
	 */
	public function __construct ($property) {
		$this->_dao = FactoryDao::createDaoProperty();
		$this->_mapperProperty = FactoryMapper::createMapperProperty();
		$this->_property = $property;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws PropertyExtraNotFoundException
	 * @throws PropertyNotFoundException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$dtoProperty = $this->_mapperProperty->fromEntityToDto($this->_dao->getPropertyById($this->_property));
		\
			//USER
		Tools::setUserToDto($dtoProperty, $dtoProperty->userCreator, $dtoProperty->userModifier);
		//EXTRA
		$command = FactoryCommand::createCommandGetAllExtrasByPropertyId($dtoProperty->id);
		try {
			$command->execute();
			$dtoProperty->extras = $command->return();
		}
		catch (ExtraNotFoundException $e) {
			$dtoProperty->extras = [];
		}
		//REQUEST
		$command = FactoryCommand::createCommandGetAllRequestByPropertyId($this->_property);
		try {
			$command->execute();
			$dtoProperty->request = $command->return();
		}
		catch (RequestNotFoundException $e) {
			$dtoProperty->request = [];
		}
		//LOCATION
		$command = FactoryCommand::createCommandGetLocationById(FactoryEntity::createLocation($dtoProperty->location));
		try {
			$command->execute();
			$dtoProperty->location = $command->return();
		}
		catch (LocationNotFoundException $e) {
		}
		//PROPERTY PRICE
		$command = FactoryCommand::createCommandGetPropertyPriceByPropertyId($this->_property);
		try {
			$command->execute();
			$dtoProperty->price = $command->return();
		}
		catch (InvalidPropertyPriceException $e) {
			$dtoProperty->price = [];
		}
		//SEAT
		$command = FactoryCommand::createCommandGetSeatById(FactoryEntity::createSeat($dtoProperty->userCreator->seat));
		try {
			$command->execute();
			$dtoProperty->userCreator->seat = $command->return();
		}
		catch (AgencyNotFoundException $e) {
			unset($dtoProperty->userModifier->seat);
		}
		catch (SeatNotFoundException $e) {
			unset($dtoProperty->userModifier->seat);
		}
		catch (LocationNotFoundException $e) {
			unset($dtoProperty->userModifier->seat);
		}
		$this->setData($dtoProperty);
	}

	/**
	 * @return DtoProperty
	 */
	public function return ():DtoProperty {
		return $this->getData();
	}
}