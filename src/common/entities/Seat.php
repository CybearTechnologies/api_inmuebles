<?php
class Seat extends Entity {
	private $_name;
	private $_rif;
	private $_active;

	/**
	 * Seat constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param string $rif
	 * @param int    $active
	 */
	public function __construct (int $id, string $name, string $rif, int $active) {
		$this->setId($id);
		$this->_name = $name;
		$this->_rif = $rif;
		$this->_active = $active;
	}

	/**
	 * @return string
	 */
	public function getName () {
		return $this->_name;
	}

	/**
	 * @param string $name
	 */
	public function setName (string $name):void {
		$this->_name = $name;
	}

	/**
	 * @return string
	 */
	public function getRif () {
		return $this->_rif;
	}

	/**
	 * @param string $rif
	 */
	public function setRif (string $rif):void {
		$this->_rif = $rif;
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