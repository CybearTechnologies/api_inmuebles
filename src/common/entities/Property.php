<?php
class Property extends Entity {
	private $_name;
	private $_area;
	private $_description;
	private $_state;
	private $_floor;
	private $_type;
	private $_location;
	private $_favorite;
	private $_destiny;

	/**
	 * Property constructor.
	 *
	 * @param int    $id
	 * @param 	     $destiny
	 * @param int    $favorite
	 * @param string $name
	 * @param float  $area
	 * @param string $description
	 * @param int    $state
	 * @param int    $floor
	 * @param int    $type
	 * @param int    $location
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, $destiny,int $favorite,string $name, float $area,string $description,
		int $state, int $floor, int $type, int $location, bool $active, bool $delete,
		int $userCreator, int $userModifier, string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->_favorite = $favorite;
		$this->_destiny = $destiny;
		$this->_name = $name;
		$this->_area = $area;
		$this->_description = $description;
		$this->_state = $state;
		$this->_floor = $floor;
		$this->_type = $type;
		$this->_location = $location;
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

	/**
	 * @return int
	 */
	public function getType ():int {
		return $this->_type;
	}

	/**
	 * @param int $type
	 */
	public function setType (int $type):void {
		$this->_type = $type;
	}

	/**
	 * @return int
	 */
	public function getLocation ():int {
		return $this->_location;
	}

	/**
	 * @param int $location
	 */
	public function setLocation (int $location):void {
		$this->_location = $location;
	}

	/**
	 * @return int
	 */
	public function getFavorite ():int {
		return $this->_favorite;
	}

	/**
	 * @param int $favorite
	 */
	public function setFavorite (int $favorite):void {
		$this->_favorite = $favorite;
	}

	/**
	 * @return mixed
	 */
	public function getDestiny () {
		return $this->_destiny;
	}

	/**
	 * @param mixed $destiny
	 */
	public function setDestiny ($destiny):void {
		$this->_destiny = $destiny;
	}




}