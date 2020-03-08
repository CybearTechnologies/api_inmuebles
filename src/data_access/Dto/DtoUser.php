<?php
class DtoUser extends Dto {
	public $firstName;
	public $lastName;
	public $address;
	public $email;
	public $password;
	public $blocked;
	public $seat;
	public $rol;
	public $plan;
	public $location;

	/**
	 * DtoUser constructor.
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
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->address = $address;
		$this->email = $email;
		$this->password = $password;
		$this->blocked = $blocked;
		$this->seat = $seat;
		$this->rol = $rol;
		$this->plan = $plan;
		$this->location = $location;
	}
}