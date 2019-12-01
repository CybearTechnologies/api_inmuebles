<?php
class DtoUser extends Dto {
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
	public function __construct (int $id, string $firstName, string $lastName, string $address, string $email,
		string $password, bool $delete, bool $blocked) {
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