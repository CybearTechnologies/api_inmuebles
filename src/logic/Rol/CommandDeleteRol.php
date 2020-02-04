<?php
class CommandDeleteRol extends Command {
	/**
	 * CommandDeleteRol constructor.
	 *
	 * @param Rol $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoRol($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->deleteRolById());
	}

	/**
	 * @return Rol
	 */
	public function return () {
		return $this->getData();
	}
}