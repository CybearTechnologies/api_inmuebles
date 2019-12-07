<?php
class Access extends Entity {
	private $_name;
	private $_abbreviation;
	private $_dateCreated;
	private $_dateModified;

	/**
	 * Access constructor.
	 *
	 * @param int    $id
	 * @param string $_name
	 * @param string $_abbreviation
	 * @param string $_dateCreated
	 * @param string $_dateModified
	 */
	public function __construct (int $id, string $_name, string $_abbreviation, string $_dateCreated,
		string $_dateModified) {
		$this->setId($id);
		$this->_name = $_name;
		$this->_abbreviation = $_abbreviation;
		$this->_dateCreated = $_dateCreated;
		$this->_dateModified = $_dateModified;
	}

	/**
	 * @return string
	 */
	public function getName ():string {
		return $this->_name;
	}

	/**
	 * @param string $name
	 */
	public function setName (string $name):void {
		$this->_name = $name;
	}

	/**
	 * @return string
	 */
	public function getAbbreviation ():string {
		return $this->_abbreviation;
	}

	/**
	 * @param string $abbreviation
	 */
	public function setAbbreviation (string $abbreviation):void {
		$this->_abbreviation = $abbreviation;
	}

	/**
	 * @return string
	 */
	public function getDateCreated ():string {
		return $this->_dateCreated;
	}

	/**
	 * @param string $dateCreated
	 */
	public function setDateCreated (string $dateCreated):void {
		$this->_dateCreated = $dateCreated;
	}

	/**
	 * @return string
	 */
	public function getDateModified ():string {
		return $this->_dateModified;
	}

	/**
	 * @param string $dateModified
	 */
	public function setDateModified (string $dateModified):void {
		$this->_dateModified = $dateModified;
	}
}