<?php
class Agency extends Entity {
	private $_name;

	/**
	 * Agency constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 */
	public function __construct (int $id, string $name) {
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
	public function setName (string $name):void {
		$this->_name = $name;
	}


}