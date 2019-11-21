<?php
class DtoAgency extends Dto {
	public $name;

	/**
	 * DtoAgency constructor.
	 *
	 * @param $id
	 * @param $name
	 */
	public function __construct (int $id, $name) {
		$this->id = $id;
		$this->name = $name;
	}
}