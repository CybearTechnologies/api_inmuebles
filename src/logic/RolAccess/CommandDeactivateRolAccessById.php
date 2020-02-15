<?php
class CommandDeactivateRolAccessById extends Command {
	/**
	 * CommandDeactivateRolAccessById constructor.
	 *
	 * @param RolAccess $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoRolAccess($entity);
	}

	/**
	 * @throws AccessNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->deactivateRolAccessById());
	}

	/**
	 * @return RolAccess
	 */
	public function return () {
		return $this->getData();
	}
}