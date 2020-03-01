<?php
class CommandUpdateRolById extends Command {
	/**
	 * CommandUpdateRolById constructor.
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
		$this->setData($this->_dao->updateRol());
	}

	/**
	 * @return Rol
	 */
	public function return () {
		return $this->getData();
	}
}