<?php
class DtoLocation extends Dto {
	public $name;
	public $type;

	/**
	 * DtoLocation constructor.
	 *
	 * @param int    $id
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 * @param string $name
	 * @param string $type
	 */
	public function __construct (int $id, int $userCreator, int $userModifier, string $dateCreated,
		string $dateModified, bool $active, bool $delete, string $name, string $type) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->name = $name;
		$this->type = $type;
	}
}