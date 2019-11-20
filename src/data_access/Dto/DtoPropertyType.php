<?php
class DtoPropertyType extends Dto {
	public $name;

	/**
	 * DtoPropertyType constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 */
	public function __construct (int $id, $name) {
		$this->id = $id;
		$this->name = $name;
	}
}