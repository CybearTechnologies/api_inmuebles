<?php
class CommandGetRolById extends Command {
	/**
	 * CommandGetRolById constructor.
	 *
	 * @param Rol $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoRol($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RolNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getRolById());
	}

	/**
	 * @return Rol
	 */
	public function return () {
		return $this->getData();
	}
}