<?php
class Location extends Entity{
	private $_name;
	private $_type;

	/**
	 * Location constructor.
	 *
	 * @param $_name
	 */
	public function __construct ($_id,$_name,$_type) {
		$this->setId($_id);
		$this->_name = $_name;
		$this->_type = $_type;
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

	/**
	 * @return mixed
	 */
	public function getType () {
		return $this->_type;
	}

	/**
	 * @param mixed $type
	 */
	public function setType ($type):void {
		$this->_type = $type;
	}

}