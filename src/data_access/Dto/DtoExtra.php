<?php
class DtoExtra extends Dto {
	public $name;
	public $active;

	/**
	 * DtoExtra constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param int    $active
	 */
	public function __construct (int $id, string $name, int $active) {
		$this->id = $id;
		$this->active = $active;
		$this->name = $name;
	}
}