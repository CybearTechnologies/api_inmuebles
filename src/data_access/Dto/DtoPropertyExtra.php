<?php
class DtoPropertyExtra extends Dto {
	public $amount;
	public $property;
	public $extra;

	/**
	 * DtoPropertyExtra constructor.
	 *
	 * @param int             $id
	 * @param int             $value
	 * @param DtoProperty|int $property
	 * @param DtoExtra|int    $extra
	 * @param bool            $active
	 * @param bool            $delete
	 * @param int             $userCreator
	 * @param int             $userModifier
	 * @param string          $dateCreated
	 * @param string          $dateModified
	 */
	public function __construct (int $id, int $value, $property, $extra, bool $active, bool $delete,
		int $userCreator, int $userModifier, string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->amount = $value;
		$this->property = $property;
		$this->extra = $extra;
	}
}