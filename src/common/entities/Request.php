<?php
class Request extends Entity {
	private $_date;
	private $_active;

	/**
	 * Request constructor.
	 *
	 * @param int    $id
	 * @param string $date
	 * @param bool   $active
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, string $date, bool $active, int $userCreator, int $userModifier,
		string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified);
		$this->_active = $active;
		$this->_date = $date;
	}

	/**
	 * @return string
	 */
	public function getDate ():string {
		return $this->_date;
	}

	/**
	 * @param string $date
	 */
	public function setDate (string $date):void {
		$this->_date = $date;
	}

	/**
	 * @return bool
	 */
	public function isActive ():bool {
		return $this->_active;
	}

	/**
	 * @param bool $active
	 */
	public function setActive (bool $active):void {
		$this->_active = $active;
	}
}