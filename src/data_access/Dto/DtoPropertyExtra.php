<?php
class DtoPropertyExtra extends Dto {
	public $amount;
	public $propertyId;
	public $extraId;

	/**
	 * DtoPropertyExtra constructor.
	 *
	 * @param int    $id
	 * @param int    $value
	 * @param int    $propertyId
	 * @param int    $extraId
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, int $value, int $propertyId,int $extraId, bool $active, bool $delete,
		int $userCreator, int $userModifier, string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->amount = $value;
		$this->propertyId = $propertyId;
		$this->extraId = $extraId;
	}
}