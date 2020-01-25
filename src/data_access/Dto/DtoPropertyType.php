<?php
class DtoPropertyType extends Dto {
	public $name;

	/**
	 * DtoPropertyType constructor.
	 *
	 * @param int    $id
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 * @param string $name
	 */
	public function __construct (int $id, int $userCreator, int $userModifier, string $dateCreated,
		string $dateModified, bool $active, bool $delete, string $name) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->id = $id;
		$this->name = $name;
	}
}