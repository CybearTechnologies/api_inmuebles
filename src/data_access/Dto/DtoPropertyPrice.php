<?php
class DtoPropertyPrice extends Dto {
	public $price;
	public $date;
	public $final;

	/**
	 * DtoPropertyPrice constructor.
	 *
	 * @param int $id
	 * @param     $price
	 * @param     $date
	 * @param     $final
	 */
	public function __construct (int $id, $price, $date, $final) {
		$this->id = $id;
		$this->price = $price;
		$this->date = $date;
		$this->final = $final;
	}
}