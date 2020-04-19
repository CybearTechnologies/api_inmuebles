<?php
class CommandDeactivateRolAccessById extends Command {
	private $_rol;
	private $_access;

	/**
	 * CommandDeactivateRolAccessById constructor.
	 *
	 * @param int $id
	 * @param int $access
	 */
	public function __construct ($id, $access) {
		$this->_dao = FactoryDao::createDaoRolAccess();
		$this->_rol = $id;
		$this->_access = $access;
	}

	/**
	 * @throws RolAccessNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->deactivateRolAccessById($this->_rol,$this->_access));
	}

	/**
	 * @return RolAccess
	 */
	public function return () {
		return $this->getData();
	}
}