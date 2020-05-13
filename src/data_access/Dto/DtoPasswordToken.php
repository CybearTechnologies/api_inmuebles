<?php
class DtoPasswordToken extends Dto {
	public $token;

	/**
	 * DtoPlan constructor.
	 *
	 * @param int         $id
	 * @param string      $token
	 * @param DtoUser|int $userCreator
	 * @param DtoUser|int $userModifier
	 * @param string      $dateCreated
	 * @param string      $dateModified
	 * @param bool        $active
	 * @param bool        $delete
	 */
	public function __construct (int $id, string $token, $userCreator, $userModifier,
		string $dateCreated, string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->token = $token;
	}
}