<?php
class DtoPropertyPrice extends Dto {
	public $price;
	public $date;
	public $final;

	/**
	 * DtoPropertyPrice constructor.
	 *
	 * @param int    $id
	 * @param float  $price
	 * @param string $date
	 * @param float  $final
	 */
	public function __construct (int $id, float $price, string $date, float $final) {
		$this->id = $id;
		$this->price = $price;
		$this->date = $date;
		$this->final = $final;
	}
}