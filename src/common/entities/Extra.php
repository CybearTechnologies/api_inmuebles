<?php
class Extra extends Entity {
	private $_name;
	private $_active;

	/**
	 * Extra constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param int    $active
	 */
	public function __construct (int $id, string $name, int $active) {
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
	 * @return int
	 */
	public function getActive ():int {
		return $this->_active;
	}

	/**
	 * @param int $active
	 */
	public function setActive (int $active):void {
		$this->_active = $active;
	}
}