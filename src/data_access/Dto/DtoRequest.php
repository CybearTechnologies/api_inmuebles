<?php
class DtoRequest extends Dto {
	public $date;

	/**
	 * DtoRequest constructor.
	 *
	 * @param int $id
	 * @param     $date
	 */
	public function __construct (int $id, $date) {
		$this->id = $id;
		$this->date = $date;
	}
}