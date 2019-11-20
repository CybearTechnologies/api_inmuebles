<?php
class DtoPlan extends Dto {
	public $name;
	public $price;

	/**
	 * DtoPlan constructor.
	 *
	 * @param $id
	 * @param $name
	 * @param $price
	 */
	public function __construct ($id, $name, $price) {
		$this->id = $id;
		$this->name = $name;
		$this->price = $price;
	}
}