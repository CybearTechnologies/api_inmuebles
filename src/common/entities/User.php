<?php
class User extends Entity {
	private $_firstName;
	private $_lastName;
	private $_address;
	private $_email;
	private $_password;
	private $_deleted;
	private $_blocked;

	/**
	 * User constructor.
	 *
	 * @param int    $id
	 * @param string $firstName
	 * @param string $lastName
	 * @param string $address
	 * @param string $email
	 * @param string $password
	 * @param bool   $deleted
	 * @param bool   $blocked
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, string $firstName, string $lastName, string $address, string $email,
		string $password, bool $deleted, bool $blocked, int $userCreator, int $userModifier,
		string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified);
		$this->_firstName = $firstName;
		$this->_lastName = $lastName;
		$this->_address = $address;
		$this->_email = $email;
		$this->_password = $password;
		$this->_deleted = $deleted;
		$this->_blocked = $blocked;
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
	public function isDeleted ():bool {
		return $this->_deleted;
	}

	/**
	 * @param bool $deleted
	 */
	public function setDeleted (bool $deleted):void {
		$this->_deleted = $deleted;
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
}