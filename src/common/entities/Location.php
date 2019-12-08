<?php
class Location extends Entity{
	private $_name;
	private $_type;

	/**
	 * Location constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param string $type
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, string $name, string $type, int $userCreator, int $userModifier,
		string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified);
		$this->_name = $name;
		$this->_type = $type;
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
}