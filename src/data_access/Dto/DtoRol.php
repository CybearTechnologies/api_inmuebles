<?php
class DtoRol extends Dto {
	public $name;
	public $access;

	/**
	 * DtoRol constructor.
	 *
	 * @param int         $id
	 * @param string      $name
	 * @param DtoAccess[] $access
	 * @param DtoUser|int $userCreator
	 * @param DtoUser|int $userModifier
	 * @param string      $dateCreated
	 * @param string      $dateModified
	 * @param bool        $active
	 * @param bool        $delete
	 */
	public function __construct (int $id, string $name, $access, int $userCreator, int $userModifier,
		string $dateCreated,
		string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->name = $name;
		$this->access = $access;
	}
}