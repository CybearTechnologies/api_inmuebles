<?php
class DtoSeat extends Dto {
	public $name;
	public $rif;

	/**
	 * DtoSeat constructor.
	 *
	 * @param int $id
	 * @param     $name
	 * @param     $rif
	 */
	public function __construct (int $id, $name, $rif) {
		$this->id = $id;
		$this->name = $name;
		$this->rif = $rif;
	}
}