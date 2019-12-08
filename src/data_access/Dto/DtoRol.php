<?php
class DtoRol extends Dto {
	public $name;
	public $active;
	public $delete;
	public $dateCreated;
	public $dateModified;
	public $userCreator;
	public $userModifier;

	/**
	 * DtoRol constructor.
	 *
	 * @param int     $id
	 * @param string  $name
	 * @param bool    $active
	 * @param bool    $delete
	 * @param DtoUser $userCreator
	 * @param DtoUser $userModifier
	 * @param string  $dateCreated
	 * @param string  $dateModified
	 */
	public function __construct (int $id, string $name, bool $active, bool $delete, $userCreator, $userModifier,
		string $dateCreated, string $dateModified) {
		$this->id = $id;
		$this->name = $name;
		$this->active = $active;
		$this->delete = $delete;
		$this->userCreator = $userCreator;
		$this->userModifier = $userModifier;
		$this->dateCreated = $dateCreated;
		$this->dateModified = $dateModified;
	}
}