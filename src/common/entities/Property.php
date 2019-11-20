<?php
class Property extends Entity {
	private $_name;
	private $_description;
	private $_publishDate;
	private $_state;
	private $_propertyType;
	private $_area;

	/**
	 * Property constructor.
	 *
	 * @param              $_id
	 * @param string       $_name
	 * @param string       $_description
	 * @param string       $_publishDate
	 * @param int          $_state
	 * @param PropertyType $_propertyType
	 * @param              $_area
	 */
	public function __construct ($_id, $_name, $_description, $_publishDate, $_state, $_propertyType, $_area) {
		$this->setId($_id);
		$this->_name = $_name;
		$this->_description = $_description;
		$this->_publishDate = $_publishDate;
		$this->_state = $_state;
		$this->_propertyType = $_propertyType;
		$this->_area = $_area;
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
	public function getDescription () {
		return $this->_description;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription ($description):void {
		$this->_description = $description;
	}

	/**
	 * @return mixed
	 */
	public function getPublishDate () {
		return $this->_publishDate;
	}

	/**
	 * @param mixed $publishDate
	 */
	public function setPublishDate ($publishDate):void {
		$this->_publishDate = $publishDate;
	}

	/**
	 * @return mixed
	 */
	public function getState () {
		return $this->_state;
	}

	/**
	 * @param mixed $state
	 */
	public function setState ($state):void {
		$this->_state = $state;
	}

	/**
	 * @return PropertyType
	 */
	public function getPropertyType ():PropertyType {
		return $this->_propertyType;
	}

	/**
	 * @param PropertyType $propertyType
	 */
	public function setPropertyType ($propertyType):void {
		$this->_propertyType = $propertyType;
	}

	/**
	 * @return mixed
	 */
	public function getArea () {
		return $this->_area;
	}

	/**
	 * @param mixed $area
	 */
	public function setArea ($area):void {
		$this->_area = $area;
	}
}