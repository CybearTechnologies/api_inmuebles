<?php
class Agency extends Entity {
	private $_name;
	private $_icon;

	/**
	 * Agency constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param string $icon
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 */
	public function __construct (int $id, string $name,string $icon, int $userCreator, int $userModifier,
		string $dateCreated, string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->_name = $name;
		$this->_icon = $icon;
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
	public function getIcon ():string {
		return $this->_icon;
	}

	/**
	 * @param string $icon
	 */
	public function setIcon (string $icon):void {
		$this->_icon = $icon;
	}

}