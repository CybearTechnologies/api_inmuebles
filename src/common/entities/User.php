<?php
class User extends Entity {
	private $_firstName;
	private $_lastName;
	private $_address;
	private $_email;
	private $_password;
	private $_blocked;
	private $_seat;
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
	 * @param string $seat
	 * @param string $rol
	 * @param string $plan
	 * @param string $location
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, string $firstName, string $lastName, string $address, string $email,
		string $password, int $userCreator, int $userModifier, bool $active, bool $blocked, bool $deleted, string $seat,
		string $rol, string $plan, string $location, string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $deleted);
		$this->_firstName = $firstName;
		$this->_lastName = $lastName;
		$this->_address = $address;
		$this->_email = $email;
		$this->_password = $password;
		$this->_deleted = $deleted;
		$this->_blocked = $blocked;
		$this->_seat = $seat;
		$this->_rol = $rol;
		$this->_plan = $plan;
		$this->_location = $location;
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
	 * @return string
	 */
	public function getSeat ():string {
		return $this->_seat;
	}

	/**
	 * @param string $seat
	 */
	public function setSeat (string $seat):void {
		$this->_seat = $seat;
	}

	/**
	 * @return string
	 */
	public function getRol ():string {
		return $this->_rol;
	}

	/**
	 * @param string $rol
	 */
	public function setRol (string $rol):void {
		$this->_rol = $rol;
	}

	/**
	 * @return string
	 */
	public function getPlan ():string {
		return $this->_plan;
	}

	/**
	 * @param string $plan
	 */
	public function setPlan (string $plan):void {
		$this->_plan = $plan;
	}

	/**
	 * @return string
	 */
	public function getLocation ():string {
		return $this->_location;
	}

	/**
	 * @param string $location
	 */
	public function setLocation (string $location):void {
		$this->_location = $location;
	}


}