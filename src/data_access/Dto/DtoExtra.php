<?php
class DtoExtra extends Dto {
	public $name;

	/**
	 * DtoExtra constructor.
	 *
	 * @param $name
	 */
	public function __construct ($id, $name) {
		$this->id = $id;
		$this->name = $name;
	}
}