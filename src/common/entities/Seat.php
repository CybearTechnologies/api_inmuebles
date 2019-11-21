<?php
class Seat extends Entity {
	private $_name;
	private $_rif;

	/**
	 * Seat constructor.
	 *
	 * @param int $_id
	 * @param     $_name
	 * @param     $_rif
	 */
	public function __construct (int $_id, $_name, $_rif) {
		$this->setId($_id);
		$this->_name = $_name;
		$this->_rif = $_rif;
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
	public function getRif () {
		return $this->_rif;
	}

	/**
	 * @param mixed $rif
	 */
	public function setRif ($rif):void {
		$this->_rif = $rif;
	}
}