<?php
class CommandGetAccessByRol extends Command {
	/**
	 * CommandGetAccessByRol constructor.
	 *
	 * @param RolAccess $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoRolAccess($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RolAccessNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAccessByRol());
	}

	/**
	 * @return RolAccess
	 */
	public function return () {
		return $this->getData();
	}
}