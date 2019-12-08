<?php
class Request extends Entity {
	private $_date;

	/**
	 * Request constructor.
	 *
	 * @param int    $id
	 * @param string $date
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, string $date, bool $active, bool $delete, int $userCreator, int $userModifier,
		string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
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
}