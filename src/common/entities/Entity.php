<?php
/**
 * Generated by Houston
 * Date: 19-Nov-19
 * Time: 12:29 PM
 */
abstract class Entity {
	private $_id;
	private $_userCreator;
	private $_userModifier;
	private $_dateCreated;
	private $_dateModified;
	private $_active;
	private $_delete;

	/**
	 * Entity constructor.
	 *
	 * @param int    $_id
	 * @param int    $_userCreator
	 * @param int    $_userModifier
	 * @param string $_dateCreated
	 * @param string $_dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 */
	public function __construct (int $_id, int $_userCreator, int $_userModifier, string $_dateCreated,
		string $_dateModified, bool $active, bool $delete) {
		$this->_id = $_id;
		$this->_userCreator = $_userCreator;
		$this->_userModifier = $_userModifier;
		$this->_dateCreated = $_dateCreated;
		$this->_dateModified = $_dateModified;
		$this->_active = $active;
		$this->_delete = $delete;
	}

	/**
	 * @return int
	 */
	public function getId () {
		return $this->_id;
	}

	/**
	 * @param int $id Entity identification.
	 */
	public function setId ($id) {
		$this->_id = $id;
	}

	/**
	 * @return int
	 */
	public function getUserCreator ():int {
		return $this->_userCreator;
	}

	/**
	 * @param int $userCreator
	 */
	public function setUserCreator (int $userCreator):void {
		$this->_userCreator = $userCreator;
	}

	/**
	 * @return mixed
	 */
	public function getUserModifier () {
		return $this->_userModifier;
	}

	/**
	 * @param mixed $userModifier
	 */
	public function setUserModifier ($userModifier):void {
		$this->_userModifier = $userModifier;
	}

	/**
	 * @return mixed
	 */
	public function getDateCreated () {
		return $this->_dateCreated;
	}

	/**
	 * @param mixed $dateCreated
	 */
	public function setDateCreated ($dateCreated):void {
		$this->_dateCreated = $dateCreated;
	}

	/**
	 * @return mixed
	 */
	public function getDateModified () {
		return $this->_dateModified;
	}

	/**
	 * @param mixed $dateModified
	 */
	public function setDateModified ($dateModified):void {
		$this->_dateModified = $dateModified;
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

	/**
	 * @return bool
	 */
	public function isDelete ():bool {
		return $this->_delete;
	}

	/**
	 * @param bool $delete
	 */
	public function setDelete (bool $delete):void {
		$this->_delete = $delete;
	}
}