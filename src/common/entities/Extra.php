<?php
class Extra extends Entity {
	private $_name;

	/**
	 * Extra constructor.
	 *
	 * @param int $id
	 * @param     $name
	 */
	public function __construct (int $id, $name) {
		$this->setId($id);
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
}