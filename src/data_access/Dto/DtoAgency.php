<?php
class DtoAgency extends Dto {
	public $name;
	public $seats;

	/**
	 * DtoAgency constructor.
	 *
	 * @param int            $id
	 * @param string         $name
	 * @param DtoSeat[]|null $seats
	 */
	public function __construct (int $id, string $name, $seats) {
		$this->id = $id;
		$this->name = $name;
		$this->seats = $seats;
	}
}