<?php
class DtoAgency extends Dto {
	public $name;
	public $seats;

	/**
	 * DtoAgency constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param        $seats
	 * @param int    $userCreator
	 * @param string $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 */
	public function __construct (int $id, string $name, $seats, int $userCreator, string $userModifier,
		string $dateCreated, string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->name = $name;
		$this->seats = $seats;
	}
}