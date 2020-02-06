<?php
class CommandCreateRol extends Command {
	/**
	 * CommandCreateRol constructor.
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
		$this->setData($this->_dao->createRol());
	}

	/**
	 * @return Rol
	 */
	public function return () {
		return $this->getData();
	}
}