<?php
class DtoAgency extends Dto {
	public $name;
	public $seats;

	/**
	 * DtoAgency constructor.
	 *
	 * @param int            $id
	 * @param int            $userCreator
	 * @param int            $userModifier
	 * @param string         $dateCreated
	 * @param string         $dateModified
	 * @param bool           $active
	 * @param bool           $delete
	 * @param string         $name
	 * @param DtoSeat[]|null $seats
	 */
	public function __construct (int $id, int $userCreator, int $userModifier, string $dateCreated,
		string $dateModified, bool $active, bool $delete, string $name, $seats) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->name = $name;
		$this->seats = $seats;
	}
}