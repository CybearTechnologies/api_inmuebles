<?php
class Plan extends Entity {
	private $_name;
	private $_price;

	/**
	 * Plan constructor.
	 *
	 * @param $_name
	 * @param $_price
	 */
	public function __construct ($_id, $_name, $_price) {
		$this->setId($_id);
		$this->_name = $_name;
		$this->_price = $_price;
	}

	/**
	 * @return mixed
	 */
	public function getName () {
		return $this->_name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName ($name):void {
		$this->_name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getPrice () {
		return $this->_price;
	}

	/**
	 * @param mixed $price
	 */
	public function setPrice ($price):void {
		$this->_price = $price;
	}
}