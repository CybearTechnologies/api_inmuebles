<?php
class DtoSeat extends Dto {
	public $name;
	public $rif;
	public $active;

	/**
	 * DtoSeat constructor.
	 *
	 * @param int    $id
	 * @param string $userCreator
	 * @param string $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 * @param string $name
	 * @param string $rif
	 */
	public function __construct (int $id,string $userCreator,string $userModifier,string $dateCreated,string $dateModified,bool $active,bool $delete, string $name, string $rif) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->name = $name;
		$this->rif = $rif;
	}
}