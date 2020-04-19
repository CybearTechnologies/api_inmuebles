<?php
class DtoSubscriptionDetail extends Dto {
	public $document;
	public $subscription;

	/**
	 * DtoSubscriptionDetail constructor.
	 *
	 * @param int    				$id
	 * @param string 				$document
	 * @param DtoSubscription|int  	$subscription
	 * @param DtoUser|int       	$userCreator
	 * @param DtoUser|int       	$userModifier
	 * @param string 				$dateCreated
	 * @param string 				$dateModified
	 * @param bool   				$active
	 * @param bool   				$delete
	 */
	public function __construct (int $id, string $document, $subscription, $userCreator, $userModifier,
		string $dateCreated, string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->document = $document;
		$this->subscription = $subscription;
	}
}