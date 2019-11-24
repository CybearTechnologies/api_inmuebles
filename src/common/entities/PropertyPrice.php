<?php
class PropertyPrice extends Entity {
	private $_price;
	private $_date;
	private $_final;

	/**
	 * PropertyPrice constructor.
	 *
	 * @param int   $id
	 * @param float $price
	 * @param       $date
	 * @param bool  $final
	 */
	public function __construct (int $id, float $price, $date, bool $final) {
		$this->setId($id);
		$this->_price = $price;
		$this->_date = $date;
		$this->_final = $final;
	}

	/**
	 * @return string
	 */
	public function getDate ():string {
		return $this->_date;
	}

	/**
	 * @param string $date
	 */
	public function setDate ($date):void {
		$this->_date = $date;
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
	public function isFinal ():bool {
		return $this->_final;
	}

	/**
	 * @param bool $final
	 */
	public function setFinal (bool $final):void {
		$this->_final = $final;
	}
}