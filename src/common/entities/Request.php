<?php
class Request extends Entity {
	private $_date;
	private $_active;

	/**
	 * Request constructor.
	 *
	 * @param int    $id
	 * @param string $date
	 * @param int    $active
	 */
	public function __construct (int $id, string $date, int $active) {
		$this->setId($id);
		$this->_active = $active;
		$this->_date = $date;
	}

	/**
	 * @return string
	 */
	public function getDate () {
		return $this->_date;
	}

	/**
	 * @param $date
	 */
	public function setDate ($date):void {
		$this->_date = $date;
	}

	/**
	 * @return int
	 */
	public function getActive ():int {
		return $this->_active;
	}

	/**
	 * @param int $active
	 */
	public function setActive (int $active):void {
		$this->_active = $active;
	}


}