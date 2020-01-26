<?php
class DtoPropertyPrice extends Dto {
	public $price;
	public $final;
	public $propertyId;

	/**
	 * DtoPropertyPrice constructor.
	 *
	 * @param int    $id
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 * @param float  $price
	 * @param bool  $final
	 * @param int    $propertyId
	 */
	public function __construct (int $id, int $userCreator, int $userModifier, string $dateCreated,
		string $dateModified, bool $active, bool $delete, float $price, bool $final, int $propertyId) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->id = $id;
		$this->price = $price;
		$this->final = $final;
		$this->propertyId = $propertyId;
	}
}