<?php
class User extends Entity {
	private $_firstName;
	private $_lastName;
	private $_address;
	private $_email;
	private $_password;
	private $_delete;
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
	 * @param bool   $delete
	 * @param bool   $blocked
	 */
	public function __construct (int $id, string $firstName, string $lastName, string $address, string $email,
		string $password, bool $delete, bool $blocked) {
		$this->setId($id);
		$this->_firstName = $firstName;
		$this->_lastName = $lastName;
		$this->_address = $address;
		$this->_email = $email;
		$this->_password = $password;
		$this->_delete = $delete;
		$this->_blocked = $blocked;
	}
}