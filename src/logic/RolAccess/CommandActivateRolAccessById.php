<?php
class CommandActivateRolAccessById extends Command {
	/**
	 * CommandActivateRolAccessById constructor.
	 *
	 * @param RolAccess $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoRolAccess($entity);
	}

	/**
	 * @throws RolAccessNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->activateRolAccessById());
	}

	/**
	 * @return RolAccess
	 */
	public function return () {
		return $this->getData();
	}
}