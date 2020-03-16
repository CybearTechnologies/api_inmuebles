<?php
class CommandGetAccessByRol extends Command {
	private $_mapperRolAccess;

	/**
	 * CommandGetAccessByRol constructor.
	 *
	 * @param RolAccess $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoRolAccess($entity);
		$this->_mapperRolAccess = FactoryMapper::createMapperRolAccess();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws RolAccessNotFoundException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$dtoAccess = $this->_mapperRolAccess->fromEntityArrayToDtoArray($this->_dao->getAccessByRol());
		foreach ($dtoAccess as $dto) {
			Tools::setUserToDto($dto, $dto->userCreator, $dto->userModifier);
		}
		$this->setData($dtoAccess);
	}

	/**
	 * @return RolAccess[]
	 */
	public function return () {
		return $this->getData();
	}
}