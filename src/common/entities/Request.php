<?php
class Request extends Entity {
	private $_date;

	/**
	 * Request constructor.
	 *
	 * @param $_date
	 */
	public function __construct (int $id, $_date) {
		$this->setId($id);
		$this->_date = $_date;
	}

	/**
	 * @return mixed
	 */
	public function getDate () {
		return $this->_date;
	}

	/**
	 * @param mixed $date
	 */
	public function setDate ($date):void {
		$this->_date = $date;
	}
}