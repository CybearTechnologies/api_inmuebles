<?php
class DtoAgency extends Dto {
	public $name;
	public $active;
	public $seats;

	/**
	 * DtoAgency constructor.
	 *
	 * @param int            $id
	 * @param string         $name
	 * @param bool           $active
	 * @param DtoSeat[]|null $seats
	 */
	public function __construct (int $id, string $name, bool $active, $seats) {
		$this->id = $id;
		$this->name = $name;
		$this->active = $active;
		$this->seats = $seats;
	}
}