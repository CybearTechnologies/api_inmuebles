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
	 * @param int    $seat
	 * @param int    $rol
	 * @param int    $plan
	 * @param int    $location
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, string $firstName, string $lastName, string $address, string $email,
		string $password, int $userCreator, int $userModifier, bool $active, bool $blocked, bool $deleted, int $seat,
		int $rol, int $plan, int $location, string $dateCreated, string $dateModified) {
		$this->id = $id;
		$this->userCreator = $userCreator;
		$this->userModifier = $userModifier;
		$this->active = $active;
		$this->dateCreated = $dateCreated;
		$this->dateModified = $dateModified;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->address = $address;
		$this->email = $email;
		$this->password = $password;
		$this->delete = $deleted;
		$this->blocked = $blocked;
		$this->seat = $seat;
		$this->rol = $rol;
		$this->plan = $plan;
		$this->location = $location;
	}
}