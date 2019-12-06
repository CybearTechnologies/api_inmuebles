<?php
class DtoPlan extends Dto {
	public $name;
	public $price;
	public $active;

	/**
	 * DtoPlan constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param float  $price
	 * @param bool   $active
	 */
	public function __construct (int $id, string $name, float $price, bool $active) {
		$this->id = $id;
		$this->name = $name;
		$this->price = $price;
		$this->active = $active;
	}
}