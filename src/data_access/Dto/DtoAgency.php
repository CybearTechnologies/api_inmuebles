<?php
class DtoAgency extends Dto {
	public $name;
	public $seats;
	public $icon;

	/**
	 * DtoAgency constructor.
	 *
	 * @param int         $id
	 * @param string      $name
	 * @param string      $icon
	 * @param DtoSeat[]   $seats
	 * @param DtoUser|int $userCreator
	 * @param DtoUser|int $userModifier
	 * @param string      $dateCreated
	 * @param string      $dateModified
	 * @param bool        $active
	 * @param bool        $delete
	 */
	public function __construct (int $id, string $name, string $icon,$seats, $userCreator, $userModifier,
		string $dateCreated, string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->name = $name;
		$this->seats = $seats;
		$this->icon = $icon;
	}
}