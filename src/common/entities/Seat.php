<?php
class Seat extends Entity {
	private $_name;
	private $_rif;
	private $_location;
	private $_agency;

	/**
	 * Seat constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param string $rif
	 * @param int    $location
	 * @param int    $agency
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, string $name, string $rif, int $location, int $agency,
		int $userCreator, int $userModifier,
		string $dateCreated, string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active,
			$delete);
		$this->_name = $name;
		$this->_rif = $rif;
		$this->_location = $location;
		$this->_agency = $agency;
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
	public function getLocation ():int {
		return $this->_location;
	}

	/**
	 * @param int $location
	 */
	public function setLocation (int $location):void {
		$this->_location = $location;
	}

	/**
	 * @return mixed
	 */
	public function getAgency () {
		return $this->_agency;
	}

	/**
	 * @param mixed $agency
	 */
	public function setAgency ($agency):void {
		$this->_agency = $agency;
	}
}