<?php
class User extends Entity {
	private $_firstName;
	private $_lastName;
	private $_address;
	private $_email;
	private $_password;
	private $_delete;
	private $_blocked;

	public function __construct (int $id, $firstName, $lastName, $address, $email, $password, $delete, $blocked) {
		$this->_firstName = $firstName;
		$this->_lastName = $lastName;
		$this->_address = $address;
		$this->_email = $email;
		$this->_password = $password;
		$this->_delete = $delete;
		$this->_blocked = $blocked;
	}
}