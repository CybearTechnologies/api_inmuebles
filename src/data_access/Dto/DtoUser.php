<?php
class DtoUser extends Dto {
	public $firstName;
	public $lastName;
	public $address;
	public $email;
	public $identity;
	public $passport;
	public $documents;
	public $password;
	public $blocked;
	public $seat;
	public $agency;
	public $rol;
	public $plan;
	public $location;

	/**
	 * DtoUser constructor.
	 *
	 * @param int             $id
	 * @param string          $firstName
	 * @param string          $lastName
	 * @param string          $address
	 * @param string          $email
	 * @param string          $password
	 * @param int             $identity
	 * @param string          $passport
	 * @param                 $documents
	 * @param DtoUser|int     $userCreator
	 * @param DtoUser|int     $userModifier
	 * @param bool            $active
	 * @param bool            $blocked
	 * @param bool            $deleted
	 * @param DtoSeat|int     $seat
	 * @param DtoAgency|int   $agency
	 * @param DtoRol|int      $rol
	 * @param DtoPlan|int     $plan
	 * @param DtoLocation|int $location
	 * @param string          $dateCreated
	 * @param string          $dateModified
	 */
	public function __construct (int $id, string $firstName, string $lastName, string $address, string $email,
		string $password, int $identity, string $passport,$documents, $userCreator, $userModifier, bool $active, bool $blocked,
		bool $deleted, $seat, $agency,$rol, $plan, $location, string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $deleted);
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->address = $address;
		$this->email = $email;
		$this->password = $password;
		$this->blocked = $blocked;
		$this->seat = $seat;
		$this->rol = $rol;
		$this->identity = $identity;
		$this->passport = $passport;
		$this->documents = $documents;
		$this->plan = $plan;
		$this->location = $location;
		$this->agency = $agency;
	}
}