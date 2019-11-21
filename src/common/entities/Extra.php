<?php
class Extra extends Entity {
	private $_name;

	/**
	 * Extra constructor.
	 *
	 * @param $_name
	 */
	public function __construct ($_id, $_name) {
		$this->setId($_id);
		$this->_name = $_name;
	}

	/**
	 * @return mixed
	 */
	public function getName () {
		return $this->_name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName ($name):void {
		$this->_name = $name;
	}
}