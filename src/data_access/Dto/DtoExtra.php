<?php
class DtoExtra extends Dto {
	public $name;

	/**
	 * DtoExtra constructor.
	 *
	 * @param int $id
	 * @param     $name
	 */
	public function __construct (int $id, $name) {
		$this->id = $id;
		$this->name = $name;
	}
}