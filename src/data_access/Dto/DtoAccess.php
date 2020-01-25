<?php
class DtoAccess extends Dto {
	public $name;
	public $abbreviation;
	public $dateCreated;
	public $dateModified;

	/**
	 * DtoAccess constructor.
	 *
	 * @param int    $id
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 * @param string $name
	 * @param string $abbreviation
	 */
	public function __construct (int $id, int $userCreator, int $userModifier, string $dateCreated,
		string $dateModified, bool $active, bool $delete, string $name, string $abbreviation) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->id = $id;
		$this->name = $name;
		$this->abbreviation = $abbreviation;
		$this->dateCreated = $dateCreated;
		$this->dateModified = $dateModified;
	}
}