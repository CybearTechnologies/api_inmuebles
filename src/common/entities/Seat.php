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
	 * @param bool   $active
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, string $name, string $rif, bool $active, int $userCreator, int $userModifier,
		string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified);
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