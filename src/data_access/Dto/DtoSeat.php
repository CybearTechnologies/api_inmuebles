<?php
class DtoSeat extends Dto {
	public $name;
	public $rif;

	/**
	 * DtoSeat constructor.
	 *
	 * @param $name
	 * @param $rif
	 */
	public function __construct ($name, $rif) {
		$this->name = $name;
		$this->rif = $rif;
	}
}