<?php
class DtoSeat extends Dto {
	public $name;
	public $rif;
	public $active;

	/**
	 * DtoSeat constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param string $rif
	 * @param bool   $active
	 */
	public function __construct (int $id, string $name, string $rif, bool $active) {
		$this->id = $id;
		$this->name = $name;
		$this->rif = $rif;
		$this->active = $active;
	}
}