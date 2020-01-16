<?php
class GetAllRolesCommand extends Command {
	/**
	 * GetAllRolesCommand constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoRol();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RolNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllRol());
	}

	/**
	 * @return Rol[]
	 */
	public function return () {
		return $this->getData();
	}
}