<?php
class CommandCreateRol extends Command {
	private $_builder;
	private $_name;
	private $_access;

	/**
	 * CommandCreateRol constructor.
	 *
	 * @param string $name
	 * @param        $access
	 */
	public function __construct ($name, $access) {
		$this->_name = $name;
		$this->_access = $access;
		$this->_builder = new RolBuilder();
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$dtoRol = $this->_builder->insertRol($this->_name, $this->_access)
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