<?php
class PropertyType extends Entity {
	private $_name;

	/**
	 * PropertyType constructor.
	 *
	 * @param int    $_id
	 * @param string $_name
	 */
	public function __construct (int $_id, $_name) {
		$this->setId($_id);
		$this->_name = $_name;
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
}