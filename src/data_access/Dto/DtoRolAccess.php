<?php
class DtoRolAccess extends Dto {
	public $rol;
	public $access;

	/**
	 * DtoRolAccess constructor.
	 *
	 * @param int         $id
	 * @param DtoRol|int  $rol
	 * @param int         $access
	 * @param DtoUser|int $userCreator
	 * @param DtoUser|int $userModifier
	 * @param string      $dateCreated
	 * @param string      $dateModified
	 * @param bool        $active
	 * @param bool        $delete
	 */
	public function __construct (int $id, int $rol, $access, $userCreator,
		$userModifier, string $dateCreated,
		string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->rol = $rol;
		$this->access = $access;
	}
}