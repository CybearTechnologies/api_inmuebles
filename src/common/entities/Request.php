<?php
class Request extends Entity {
	private $_date;
	private $_active;

	/**
	 * Request constructor.
	 *
	 * @param int    $id
	 * @param string $date
	 * @param bool   $active
	 */
	public function __construct (int $id, string $date, bool $active) {
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