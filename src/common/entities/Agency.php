<?php
class Agency extends Entity {
	private $_name;
	private $_seats = [];

	/**
	 * Agency constructor.
	 *
	 * @param        $_id
	 * @param        $_name
	 * @param Seat[] $_seats
	 */
	public function __construct ($_id, $_name, $_seats) {
		$this->setId($_id);
		$this->_name = $_name;
		$this->_seats = $_seats;
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
	public function getSeats () {
		return $this->_seats;
	}

	/**
	 * @param mixed $seats
	 */
	public function setSeats ($seats):void {
		$this->_seats = $seats;
	}
}