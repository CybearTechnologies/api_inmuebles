<?php
class RolAccess extends Entity {
	private $_rol;
	private $_access;

	/**
	 * RolAccess constructor.
	 *
	 * @param int    $id
	 * @param int    $rol
	 * @param int    $access
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 */
	public function __construct (int $id, int $rol, int $access, int $userCreator,
		int $userModifier, string $dateCreated,
		string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->_rol = $rol;
		$this->_access = $access;
	}

	/**
	 * @return int
	 */
	public function getRol ():int {
		return $this->_rol;
	}

	/**
	 * @param int $rol
	 */
	public function setRol (int $rol):void {
		$this->_rol = $rol;
	}

	/**
	 * @return int
	 */
	public function getAccess ():int {
		return $this->_access;
	}

	/**
	 * @param int $access
	 */
	public function setAccess (int $access):void {
		$this->_access = $access;
	}
}