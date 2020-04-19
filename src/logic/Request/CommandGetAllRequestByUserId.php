<?php
class CommandGetAllRequestByUserId extends Command {
	private $_userId;
	private $_mapperRequest;

	/**
	 * CommandGetAllRequestByUserId constructor.
	 *
	 * @param int $user
	 */
	public function __construct ($user) {
		$this->_dao = FactoryDao::createDaoRequest();
		$this->_mapperRequest = FactoryMapper::createMapperRequest();
		$this->_userId = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws RequestNotFoundException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$dtoRequest = $this->_mapperRequest->fromEntityArrayToDtoArray($this->_dao->getAllRequestByUserId($this->_userId));
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