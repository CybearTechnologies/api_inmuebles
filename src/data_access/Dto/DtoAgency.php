<?php
class DtoAgency extends Dto {
	public $name;
	public $seat = [];

	/**
	 * DtoAgency constructor.
	 *
	 * @param int  $id
	 * @param      $name
	 * @param Seat $seat []
	 */
	public function __construct (int $id, $name, $seat) {
		$this->id = $id;
		$this->name = $name;
		$this->seat = $seat;
	}
}