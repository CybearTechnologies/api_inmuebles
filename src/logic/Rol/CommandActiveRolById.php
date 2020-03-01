<?php
class CommandActiveRolById extends Command {
	/**
	 * CommandActiveRolById constructor.
	 *
	 * @param $rol
	 */
	public function __construct ($rol) {
		$this->_dao = FactoryDao::createDaoRol($rol);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RolNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->activeRol());
	}

	/**
	 * @return Rol
	 */
	public function return () {
		return $this->getData();
	}
}