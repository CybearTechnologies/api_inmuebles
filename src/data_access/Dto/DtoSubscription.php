<?php
class DtoSubscription extends Dto {
	public $ci;
	public $passport;
	public $password;
	public $email;
	public $subsDetails;
	public $plan;
	public $location;
	public $seat;

	/**
	 * DtoSubscription constructor.
	 *
	 * @param int                     		$id
	 * @param DtoPlan|int             		$plan
	 * @param DtoSeat|int             		$seat
	 * @param DtoLocation|int         		$location
	 * @param int                     		$ci
	 * @param string                  		$passport
	 * @param string                  		$email
	 * @param string                  		$password
	 * @param array|DtoSubscriptionDetail[] $subsDetails
	 * @param DtoUser|int             		$userCreator
	 * @param DtoUser|int             		$userModifier
	 * @param string                  		$dateCreated
	 * @param string                  		$dateModified
	 * @param bool                    		$active
	 * @param bool                    		$delete
	 */
	public function __construct (int $id, $plan,$seat,$location,int $ci, string $passport,
		string $email, string $password,$subsDetails, $userCreator, $userModifier, string $dateCreated,
		string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified,
			$active, $delete);
		$this->plan = $plan;
		$this->seat= $seat;
		$this->location = $location;
		$this->ci = $ci;
		$this->passport = $passport;
		$this->password = $password;
		$this->email = $email;
		$this->subsDetails = $subsDetails;
	}

}