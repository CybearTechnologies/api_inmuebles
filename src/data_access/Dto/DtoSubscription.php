<?php
class DtoSubscription extends Dto {
	public $ci;
	public $firstName;
	public $lastName;
	public $address;
	public $passport;
	public $password;
	public $email;
	public $detail;
	public $plan;
	public $location;
	public $seat;
	public $status;

	/**
	 * DtoSubscription constructor.
	 *
	 * @param int                           $id
	 * @param string                        $firstName
	 * @param string                        $lastName
	 * @param string                        $address
	 * @param DtoPlan|int                   $plan
	 * @param DtoSeat|int                   $seat
	 * @param DtoLocation|int               $location
	 * @param int                           $ci
	 * @param string                        $passport
	 * @param string                        $email
	 * @param string                        $password
	 * @param array|DtoSubscriptionDetail[] $detail
	 * @param DtoUser|int                   $userCreator
	 * @param DtoUser|int                   $userModifier
	 * @param string                        $dateCreated
	 * @param string                        $dateModified
	 * @param bool                          $active
	 * @param bool                          $delete
	 * @param bool                          $status
	 */
	public function __construct (int $id, string $firstName, string $lastName, string $address,
		$plan,$seat,$location,int $ci, string $passport, string $email, string $password,
		$detail, $userCreator, $userModifier, string $dateCreated,
		string $dateModified, bool $active, bool $delete,bool $status) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified,
			$active, $delete);
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->address = $address;
		$this->plan = $plan;
		$this->seat= $seat;
		$this->location = $location;
		$this->ci = $ci;
		$this->passport = $passport;
		$this->password = $password;
		$this->email = $email;
		$this->detail = $detail;
		$this->status = $status;
	}

}