<?php
class Plan extends Entity {
	private $_name;
	private $_price;
	private $_active;

	/**
	 * Plan constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param float  $price
	 * @param bool   $active
	 */
	public function __construct (int $id, string $name, float $price, bool $active) {
		$this->setId($id);
		$this->_name = $name;
		$this->_price = $price;
		$this->_active = $active;
	}

	/**
	 * @return string
	 */
	public function getName ():string {
		return $this->_name;
	}

	/**
	 * @param string $name
	 */
	public function setName (string $name):void {
		$this->_name = $name;
	}

	/**
	 * @return float
	 */
	public function getPrice ():float {
		return $this->_price;
	}

	/**
	 * @param float $price
	 */
	public function setPrice (float $price):void {
		$this->_price = $price;
	}

	/**
	 * @return bool
	 */
	public function isActive ():bool {
		return $this->_active;
	}

	/**
	 * @param bool $active
	 */
	public function setActive (bool $active):void {
		$this->_active = $active;
	}
}