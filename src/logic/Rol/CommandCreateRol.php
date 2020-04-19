<?php
class CommandCreateRol extends Command {
	private $_builder;
	private $_name;
	private $_access;
	private $_user;

	/**
	 * CommandCreateRol constructor.
	 *
	 * @param string $name
	 * @param        $access
	 * @param        $user
	 */
	public function __construct ($name, $access, $user) {
		$this->_name = $name;
		$this->_access = $access;
		$this->_user = $user;
		$this->_builder = new RolBuilder();
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$dtoRol = $this->_builder->insertRol($this->_name, $this->_access,$this->_user)
			->withAccess()
			->clean()
			->build();
		$this->setData($dtoRol);
	}

	/**
	 * @return Rol
	 */
	public function return () {
		return $this->getData();
	}
}