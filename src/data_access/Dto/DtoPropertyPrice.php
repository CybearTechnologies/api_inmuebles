<?php
class DtoPropertyPrice extends Dto {
	public $price;
	public $final;
	public $propertyId;

	/**
	 * DtoPropertyPrice constructor.
	 *
	 * @param int    $id
	 * @param float  $price
	 * @param bool   $final
	 * @param int    $property
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 */
	public function __construct (int $id, float $price, bool $final, int $property, int $userCreator,
		int $userModifier, string $dateCreated, string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->id = $id;
		$this->price = $price;
		$this->final = $final;
		$this->propertyId = $property;
	}
}