<?php
class Property extends Entity {
	private $_name;
	private $_area;
	private $_description;
	private $_state;
	private $_floor;

	/**
	 * Property constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param float  $area
	 * @param string $description
	 * @param int    $state
	 * @param int    $floor
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, string $name, float $area, string $description,
		int $state, int $floor, bool $active, bool $delete, int $userCreator, int $userModifier,
		string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->_name = $name;
		$this->_area = $area;
		$this->_description = $description;
		$this->_state = $state;
		$this->_floor = $floor;
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
}