<?php
class Extra extends Entity {
	private $_name;
	private $_active;

	/**
	 * Extra constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param bool   $active
	 */
	public function __construct (int $id, string $name, bool $active) {
		$this->setId($id);
		$this->_active = $active;
		$this->_name = $name;
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
}