<?php
class DtoRolAccess extends Dto {
	public $rol;
	public $access;
	public $accessName;

	/**
	 * DtoRolAccess constructor.
	 *
	 * @param int    $id
	 * @param int    $rol
	 * @param int    $access
	 * @param string $accessName
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 */
	public function __construct (int $id, int $rol, int $access, string $accessName, int $userCreator,
		int $userModifier, string $dateCreated,
		string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->rol = $rol;
		$this->access = $access;
		$this->accessName = $accessName;
	}
}