<?php
class User extends Entity {
	private $_firstName;
	private $_lastName;
	private $_address;
	private $_email;
	private $_password;
	private $_blocked;
	private $_seat;
	private $_agency;
	private $_rol;
	private $_plan;
	private $_location;

	/**
	 * User constructor.
	 *
	 * @param int    $id
	 * @param string $firstName
	 * @param string $lastName
	 * @param string $address
	 * @param string $email
	 * @param string $password
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param bool   $active
	 * @param bool   $blocked
	 * @param bool   $deleted
	 * @param	     $seat
	 * @param 	     $agency
	 * @param int    $rol
	 * @param int    $plan
	 * @param int    $location
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, string $firstName, string $lastName, string $address, string $email,
		string $password, int $userCreator, int $userModifier, bool $active, bool $blocked, bool $deleted,$seat,
		$agency,int $rol, int $plan, int $location, string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $deleted);
		$this->_firstName = $firstName;
		$this->_lastName = $lastName;
		$this->_address = $address;
		$this->_email = $email;
		$this->_password = $password;
		$this->_blocked = $blocked;
		$this->_seat = $seat;
		$this->_rol = $rol;
		$this->_plan = $plan;
		$this->_location = $location;
		$this->_agency = $agency;
	}

	/**
	 * @return string
	 */
	public function getFirstName ():string {
		return $this->_firstName;
	}

	/**
	 * @param string $firstName
	 */
	public function setFirstName (string $firstName):void {
		$this->_firstName = $firstName;
	}

	/**
	 * @return string
	 */
	public function getLastName ():string {
		return $this->_lastName;
	}

	/**
	 * @param string $lastName
	 */
	public function setLastName (string $lastName):void {
		$this->_lastName = $lastName;
	}

	/**
	 * @return string
	 */
	public function getAddress ():string {
		return $this->_address;
	}

	/**
	 * @param string $address
	 */
	public function setAddress (string $address):void {
		$this->_address = $address;
	}

	/**
	 * @return string
	 */
	public function getEmail ():string {
		return $this->_email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail (string $email):void {
		$this->_email = $email;
	}

	/**
	 * @return string
	 */
	public function getPassword ():string {
		return $this->_password;
	}

	/**
	 * @param string $password
	 */
	public function setPassword (string $password):void {
		$this->_password = $password;
	}

	/**
	 * @return bool
	 */
	public function isBlocked ():bool {
		return $this->_blocked;
	}

	/**
	 * @param bool $blocked
	 */
	public function setBlocked (bool $blocked):void {
		$this->_blocked = $blocked;
	}

	/**
	 * @return mixed
	 */
	public function getSeat (){
		return $this->_seat;
	}

	/**
	 * @param int $seat
	 */
	public function setSeat (int $seat):void {
		$this->_seat = $seat;
	}

	/**
	 * @return int
	 */
	public function getRol ():int {
		return $this->_rol;
	}

	/**
	 * @param int $rol
	 */
	public function setRol (int $rol):void {
		$this->_rol = $rol;
	}

	/**
	 * @return int
	 */
	public function getPlan ():int {
		return $this->_plan;
	}

	/**
	 * @param int $plan
	 */
	public function setPlan (int $plan):void {
		$this->_plan = $plan;
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


	public function getAgency () {
		return $this->_agency;
	}

	/**
	 * @param int $agency
	 */
	public function setAgency (int $agency):void {
		$this->_agency = $agency;
	}



}