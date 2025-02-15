<?php
class DtoPlan extends Dto {
	public $name;
	public $price;

	/**
	 * DtoPlan constructor.
	 *
	 * @param int         $id
	 * @param string      $name
	 * @param float       $price
	 * @param DtoUser|int $userCreator
	 * @param DtoUser|int $userModifier
	 * @param string      $dateCreated
	 * @param string      $dateModified
	 * @param bool        $active
	 * @param bool        $delete
	 */
	public function __construct (int $id, string $name, float $price, $userCreator, $userModifier,
		string $dateCreated, string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->name = $name;
		$this->price = $price;
	}
}