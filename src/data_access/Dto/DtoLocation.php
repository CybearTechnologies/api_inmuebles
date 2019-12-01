<?php
class DtoLocation extends Dto {
	public $name;
	public $type;

	/**
	 * DtoLocation constructor.
	 *
	 * @param int $id
	 * @param string    $name
	 * @param string    $type
	 */
	public function __construct (int $id, string $name, string $type) {
		$this->id = $id;
		$this->name = $name;
		$this->type = $type;
	}
}