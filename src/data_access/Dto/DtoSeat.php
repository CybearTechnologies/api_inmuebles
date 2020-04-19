<?php
class DtoSeat extends Dto {
	public $name;
	public $rif;
	public $active;
	public $location;
	public $agency;

	/**
	 * DtoSeat constructor.
	 *
	 * @param int             $id
	 * @param string          $name
	 * @param string          $rif
	 * @param DtoLocation|int $location
	 * @param DtoAgency|int   $agency
	 * @param DtoUser|int     $userCreator
	 * @param DtoUser|int     $userModifier
	 * @param string          $dateCreated
	 * @param string          $dateModified
	 * @param bool            $active
	 * @param bool            $delete
	 */
	public function __construct (int $id, string $name, string $rif, $location, $agency,
		$userCreator, $userModifier, string $dateCreated, string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->name = $name;
		$this->location = $location;
		$this->rif = $rif;
		$this->agency = $agency;
	}
}