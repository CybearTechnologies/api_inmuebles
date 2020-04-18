<?php
class CommandCreateRolAccess extends Command {
	private $_entity;

	/**
	 * CommandCreateRolAccess constructor.
	 *
	 * @param RolAccess $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoRolAccess();
		$this->_entity = $entity;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$rol = $this->_entity->getRol();
		$access = $this->_entity->getAccess();
		$user = $this->_entity->getUserCreator();
		$this->setData($this->_dao->createRolAccess($rol, $access, $user));
	}

	/**
	 * @return RolAccess
	 */
	public function return () {
		return $this->getData();
	}
}