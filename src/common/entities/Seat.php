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
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, string $name, string $rif, bool $active, bool $delete, int $userCreator,
		int $userModifier,
		string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
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