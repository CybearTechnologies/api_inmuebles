<?php
class DtoLocation extends Dto {
	public $name;
	public $type;
	public $nameS;
	public $idS;

	/**
	 * DtoLocation constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param string $type
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 * @param String $nameS
	 * @param int    $idS
	 */
	public function __construct (int $id, string $name, string $type, int $userCreator,
		int $userModifier, string $dateCreated, string $dateModified, bool $active, bool $delete, String $nameS, int $idS) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->id = $id;
		$this->name = $name;
		$this->type = $type;
		$this->nameS=$nameS;
		$this->idS= $idS;
	}

}