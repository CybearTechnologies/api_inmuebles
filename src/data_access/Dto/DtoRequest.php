<?php
class DtoRequest extends Dto {
	public $property;

	/**
	 * DtoRequest constructor.
	 *
	 * @param int             $id
	 * @param DtoProperty|int $property
	 * @param DtoUser|int     $userCreator
	 * @param DtoUser|int     $userModifier
	 * @param string          $dateCreated
	 * @param string          $dateModified
	 * @param bool            $active
	 * @param bool            $delete
	 */
	public function __construct (int $id, int $property, $userCreator, $userModifier, string $dateCreated,
		string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->property = $property;
	}
}