<?php
class CommandCreateRolAccess extends Command {
	/**
	 * CommandCreateRolAccess constructor.
	 *
	 * @param RolAccess $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoRolAccess($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->createRolAccess());
	}

	/**
	 * @return RolAccess
	 */
	public function return () {
		return $this->getData();
	}
}