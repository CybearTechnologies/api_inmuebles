<?php
class Agency extends Entity {
	private $_name;
	private $_active;

	/**
	 * Agency constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param bool   $active
	 */
	public function __construct (int $id, string $name, bool $active) {
		$this->setId($id);
		$this->_name = $name;
		$this->_active = $active;
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
}