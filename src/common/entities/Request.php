<?php
class Request extends Entity {
	private $_date;

	/**
	 * Request constructor.
	 *
	 * @param int $id
	 * @param     $date
	 */
	public function __construct (int $id, $date) {
		$this->setId($id);
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
}