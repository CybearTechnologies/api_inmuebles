<?php
class DtoAccess extends Dto {
	public $name;
	public $abbreviation;
	public $dateCreated;
	public $dateModified;

	/**
	 * DtoAccess constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param string $abbreviation
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, string $name, string $abbreviation, string $dateCreated,
		string $dateModified) {
		$this->id = $id;
		$this->name = $name;
		$this->abbreviation = $abbreviation;
		$this->dateCreated = $dateCreated;
		$this->dateModified = $dateModified;
	}
}