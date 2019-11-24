<?php
class Seat extends Entity {
	private $_name;
	private $_rif;

	/**
	 * Seat constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param string $rif
	 */
	public function __construct (int $id, string $name, string $rif) {
		$this->setId($id);
		$this->_name = $name;
		$this->_rif = $rif;
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
}