<?php
class CommandGetAllRequestByPropertyId extends Command {
	private $_mapperRequest;
	private $_property;

	/**
	 * CommandGetAllRequestByPropertyId constructor.
	 *
	 * @param $property
	 */
	public function __construct ($property) {
		$this->_dao = FactoryDao::createDaoRequest();
		$this->_mapperRequest = FactoryMapper::createMapperRequest();
		$this->_property = $property;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws RequestNotFoundException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$dtoRequest = $this->_mapperRequest->fromEntityArrayToDtoArray($this->_dao->getAllRequestByPropertyId($this->_property));
		foreach ($dtoRequest as $dto) {
			Tools::setUserToDto($dto, $dto->userCreator, $dto->userModifier);
		}
		$this->setData($dtoRequest);
	}

	/**
	 * @return DtoRequest[]
	 */
	public function return () {
		return $this->getData();
	}
}