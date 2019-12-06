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
	 */
	public function __construct (int $id, string $name, bool $active,int $user) {
		$this->setId($id);
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
	public function setName ($name):void {
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