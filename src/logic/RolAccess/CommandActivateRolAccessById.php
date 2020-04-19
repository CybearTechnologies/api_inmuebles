<?php
class CommandActivateRolAccessById extends Command {
	private $_rol;
	private $_access;

	/**
	 * CommandActivateRolAccessById constructor.
	 *
	 * @param int $rol
	 * @param int $access
	 */
	public function __construct ($rol, $access) {
		$this->_dao = FactoryDao::createDaoRolAccess();
		$this->_rol = $rol;
		$this->_access = $access;
	}

	/**
	 * @throws RolAccessNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->activateRolAccessById($this->_rol,$this->_access));
	}

	/**
	 * @return RolAccess
	 */
	public function return () {
		return $this->getData();
	}
}