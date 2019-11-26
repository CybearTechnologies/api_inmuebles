<?php
class DtoRequest extends Dto {
	public $date;
	public $active;

	/**
	 * DtoRequest constructor.
	 *
	 * @param int    $id
	 * @param string $date
	 * @param int    $active
	 */
	public function __construct (int $id, string $date, int $active) {
		$this->id = $id;
		$this->active = $active;
		$this->date = $date;
	}
}