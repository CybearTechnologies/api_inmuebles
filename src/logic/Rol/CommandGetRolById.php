<?php
class CommandGetRolById extends Command {
	private $_mapperRol;

	/**
	 * CommandGetRolById constructor.
	 *
	 * @param Rol $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoRol($entity);
		$this->_mapperRol = FactoryMapper::createMapperRol();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws RolNotFoundException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$dtoRol = $this->_mapperRol->fromEntityToDto($this->_dao->getRolById());
		Tools::setUserToDto($dtoRol,$dtoRol->userCreator,$dtoRol->userModifier);
		$this->setData($dtoRol);
	}

	/**
	 * @return DtoRol
	 */
	public function return () {
		return $this->getData();
	}
}