<?php
class Access extends Entity {
	private $_name;
	private $_abbreviation;

	/**
	 * access constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param string $abbreviation
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 */
	public function __construct (int $id, string $name, string $abbreviation, int $userCreator, int $userModifier,
		string $dateCreated, string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->_name = $name;
		$this->_abbreviation = $abbreviation;
	}

	/**
	 * @return string
	 */
	public function getName ():string {
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
	public function getAbbreviation ():string {
		return $this->_abbreviation;
	}

	/**
	 * @param string $abbreviation
	 */
	public function setAbbreviation (string $abbreviation):void {
		$this->_abbreviation = $abbreviation;
	}
}