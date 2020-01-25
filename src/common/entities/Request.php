<?php
class Request extends Entity {

	private $_property;

	/**
	 * Request constructor.
	 *
	 * @param int    $id
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $property
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, bool $active, bool $delete,int $property, int $userCreator, int $userModifier,
		string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->_property=$property;
	}

	/**
	 * @return int
	 */
	public function getProperty ():int {
		return $this->_property;
	}

	/**
	 * @param int $property
	 */
	public function setProperty (int $property):void {
		$this->_property = $property;
	}


}