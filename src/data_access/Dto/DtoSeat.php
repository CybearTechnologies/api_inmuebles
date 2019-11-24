<?php
class DtoSeat extends Dto {
	public $name;
	public $rif;

	/**
	 * DtoSeat constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param string $rif
	 */
	public function __construct (int $id, string $name, string $rif) {
		$this->id = $id;
		$this->name = $name;
		$this->rif = $rif;
	}
}