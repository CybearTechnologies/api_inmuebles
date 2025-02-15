<?php
class DtoPropertyType extends Dto {
	public $name;
	public $image;

	/**
	 * DtoPropertyType constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param string $image
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 */
	public function __construct (int $id, string $name, string $image, int $userCreator, int $userModifier,
		string $dateCreated, string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->name = $name;
		$this->image = $image;
	}
}