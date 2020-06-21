<?php
class Subscription extends Entity {
	private $_ci;
	private $_firstName;
	private $_lastName;
	private $_address;
	private $_passport;
	private $_email;
	private $_password;
	private $_plan;
	private $_seat;
	private $_agency;
	private $_location;
	private $_status;

	/**
	 * Subscription constructor.
	 *
	 * @param int    $id
	 * @param string $ci
	 * @param string $firstName
	 * @param string $lastName
	 * @param string $address
	 * @param string $_passport
	 * @param string $email
	 * @param string $password
	 * @param int    $plan
	 * @param int    $seat
	 * @param int    $agency
	 * @param int    $location
	 * @param bool   $status
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 */
	public function __construct (int $id, string $ci, string $firstName, string $lastName,
		string $address, string $_passport, string $email, string $password,
		int $plan, $seat, $agency,int $location, bool $status, int $userCreator, int $userModifier,
		string $dateCreated, string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active,
			$delete);
		$this->_ci = $ci;
		$this->_firstName = $firstName;
		$this->_lastName = $lastName;
		$this->_address = $address;
		$this->_passport = $_passport;
		$this->_email = $email;
		$this->_password = $password;
		$this->_plan = $plan;
		$this->_seat = $seat;
		$this->_location = $location;
		$this->_status = $status;
		$this->_agency = $agency;
	}

	/**
	 * @return mixed
	 */
	public function getCi () {
		return $this->_ci;
	}

	/**
	 * @param mixed $ci
	 */
	public function setCi ($ci):void {
		$this->_ci = $ci;
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
	 * @return mixed
	 */
	public function getPassport () {
		return $this->_passport;
	}

	/**
	 * @param mixed $passport
	 */
	public function setPassport ($passport):void {
		$this->_passport = $passport;
	}

	/**
	 * @return mixed
	 */
	public function getEmail () {
		return $this->_email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail ($email):void {
		$this->_email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getPassword () {
		return $this->_password;
	}

	/**
	 * @param mixed $password
	 */
	public function setPassword ($password):void {
		$this->_password = $password;
	}

	/**
	 * @return mixed
	 */
	public function getPlan () {
		return $this->_plan;
	}

	/**
	 * @param mixed $plan
	 */
	public function setPlan ($plan):void {
		$this->_plan = $plan;
	}

	/**
	 * @return mixed
	 */
	public function getSeat () {
		return $this->_seat;
	}

	/**
	 * @param mixed $seat
	 */
	public function setSeat ($seat):void {
		$this->_seat = $seat;
	}

	/**
	 * @return mixed
	 */
	public function getLocation () {
		return $this->_location;
	}

	/**
	 * @param mixed $location
	 */
	public function setLocation ($location):void {
		$this->_location = $location;
	}

	/**
	 * @return bool
	 */
	public function isStatus ():bool {
		return $this->_status;
	}

	/**
	 * @param bool $status
	 */
	public function setStatus (bool $status):void {
		$this->_status = $status;
	}

	/**
	 * @return int
	 */
	public function getAgency ():int {
		return $this->_agency;
	}

	/**
	 * @param int $agency
	 */
	public function setAgency (int $agency):void {
		$this->_agency = $agency;
	}


}