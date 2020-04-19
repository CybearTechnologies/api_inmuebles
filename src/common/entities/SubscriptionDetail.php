<?php
class SubscriptionDetail extends Entity {
	private $_document;
	private $_subscription;

	/**
	 * SubscriptionDetail constructor.
	 *
	 * @param int    $id
	 * @param int    $subscription
	 * @param string $document
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 */
	public function __construct (int $id, int $subscription, string $document, int $userCreator, int $userModifier,
		string $dateCreated, string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->_subscription = $subscription;
		$this->_document = $document;
	}

	/**
	 * @return int
	 */
	public function getSubscription ():int {
		return $this->_subscription;
	}

	/**
	 * @param int $subscription
	 */
	public function setSubscription (int $subscription):void {
		$this->_subscription = $subscription;
	}

	/**
	 * @return mixed
	 */
	public function getDocument () {
		return $this->_document;
	}

	/**
	 * @param mixed $document
	 */
	public function setDocument ($document):void {
		$this->_document = $document;
	}
}