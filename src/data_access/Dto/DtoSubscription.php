<?php
class DtoSubscription extends Dto {
	public $ci;
	public $passport;
	public $email;
	public $subsDetails;

	/**
	 * DtoSubscription constructor.
	 *
	 * @param int    $id
	 * @param int    $ci
	 * @param string $passport
	 * @param string $email
	 * @param DtoSubscriptionDetail[] $subsDetails
	 * @param        $userCreator
	 * @param        $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 */
	public function __construct (int $id, int $ci, string $passport, string $email,$subsDetails,
		$userCreator, $userModifier, string $dateCreated, string $dateModified, bool $active,
		bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->ci = $ci;
		$this->passport = $passport;
		$this->email = $email;
		$this->subsDetails = $subsDetails;
	}
}