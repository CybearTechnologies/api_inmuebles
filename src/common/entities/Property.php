<?php
class Property extends Entity {
	private $_name;
	private $_area;
	private $_description;
	private $_publishDate;
	private $_state;
	private $_floor;
	private $_extra;

	/**
	 * Property constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param float  $area
	 * @param string $description
	 * @param string $publishDate
	 * @param int    $state
	 * @param int    $floor
	 * @param int    $extra
	 */
	public function __construct (int $id, string $name, float $area, string $description, string $publishDate,
		int $state, int $floor, int $extra) {
		$this->setId($id);
		$this->_name = $name;
		$this->_area = $area;
		$this->_description = $description;
		$this->_publishDate = $publishDate;
		$this->_state = $state;
		$this->_floor = $floor;
		$this->_extra = $extra;
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
	public function getArea () {
		return $this->_area;
	}

	/**
	 * @param mixed $area
	 */
	public function setArea ($area):void {
		$this->_area = $area;
	}

	/**
	 * @return string
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
	 * @return string
	 */
	public function getState () {
		return $this->_state;
	}

	/**
	 * @param string $state
	 */
	public function setState ($state):void {
		$this->_state = $state;
	}

	/**
	 * @return string
	 */
	public function getFloor ():string {
		return $this->_floor;
	}

	/**
	 * @param mixed $floor
	 */
	public function setFloor ($floor):void {
		$this->_floor = $floor;
	}

	/**
	 * @return int
	 */
	public function getExtra ():int {
		return $this->_extra;
	}

	/**
	 * @param int $extra
	 */
	public function setExtra (int $extra):void {
		$this->_extra = $extra;
	}
}