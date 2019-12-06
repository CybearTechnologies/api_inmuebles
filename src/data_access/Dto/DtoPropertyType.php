<?php
class DtoPropertyType extends Dto {
	public $name;
	public $active;

	/**
	 * DtoPropertyType constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param bool   $active
	 */
	public function __construct (int $id, string $name, bool $active) {
		$this->id = $id;
		$this->name = $name;
		$this->active = $active;
	}
}