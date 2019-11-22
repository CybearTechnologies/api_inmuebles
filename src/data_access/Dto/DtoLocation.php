<?php
class DtoLocation extends Dto {
	public $name;
	public $type;

	/**
	 * DtoLocation constructor.
	 *
	 * @param int $id
	 * @param     $name
	 * @param     $type
	 */
	public function __construct (int $id, $name, $type) {
		$this->id = $id;
		$this->name = $name;
		$this->type = $type;
	}
}