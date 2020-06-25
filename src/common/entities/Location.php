<?php
class Location extends Entity {
	private $_name;
	private $_type;
	private $_locationFk;

	/**
	 * Location constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param string $type
	 * @param        $locationFk
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 */
	public function __construct (int $id, string $name, string $type, $locationFk, int $userCreator,
		int $userModifier, string $dateCreated, string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->_name = $name;
		$this->_type = $type;
		$this->_locationFk = $locationFk;
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
	public function getType ():string {
		return $this->_type;
	}

	/**
	 * @param string $type
	 */
	public function setType (string $type):void {
		$this->_type = $type;
	}

	/**
	 * @return mixed
	 */
	public function getLocationFk () {
		return $this->_locationFk;
	}

	/**
	 * @param int $locationFk
	 */
	public function setLocationFk (int $locationFk) {
		$this->_locationFk = $locationFk;
	}
}