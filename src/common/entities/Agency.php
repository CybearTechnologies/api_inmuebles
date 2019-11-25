<?php
class Agency extends Entity {
	private $_name;
	private $_active;

	/**
	 * Agency constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param int    $active
	 */
	public function __construct (int $id, string $name, int $active) {
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