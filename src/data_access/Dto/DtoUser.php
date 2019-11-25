<?php
class DtoUser extends Entity {
	public $firstName;
	public $lastName;
	public $address;
	public $email;
	public $password;
	public $delete;
	public $blocked;

	/**
	 * DtoUser constructor.
	 *
	 * @param int $id
	 * @param     $firstName
	 * @param     $lastName
	 * @param     $address
	 * @param     $email
	 * @param     $password
	 * @param     $delete
	 * @param     $blocked
	 */
	public function __construct (int $id, $firstName, $lastName, $address, $email, $password, $delete, $blocked) {
		$this->id = $id;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->address = $address;
		$this->email = $email;
		$this->password = $password;
		$this->delete = $delete;
		$this->blocked = $blocked;
	}
}