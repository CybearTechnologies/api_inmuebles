<?php
class PropertyType extends Entity {
	private $_name;
	private $_active;
	private $_user;

	/**
	 * PropertyType constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param bool   $active
	 * @param int    $user
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, string $name, bool $active, int $user, int $userCreator, int $userModifier,
		string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified);
		$this->_name = $name;
		$this->_active = $active;
		$this->_user = $user;
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

	/**
	 * @return int
	 */
	public function getUser ():int {
		return $this->_user;
	}

	/**
	 * @param int $user
	 */
	public function setUser (int $user):void {
		$this->_user = $user;
	}
}