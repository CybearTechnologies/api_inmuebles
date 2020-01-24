<?php
class DtoProperty extends Dto {
	public $id;
	public $name;
	public $area;
	public $description;
	public $publishDate;
	public $state;
	public $floor;
	public $extras;
	public $request;
	public $user;
	public $price;
	/**
	 * DtoProperty constructor.
	 *
	 * @param int                $id
	 * @param int                $userCreator
	 * @param int                $userModifier
	 * @param int                $dateCreated
	 * @param int                $dateModified
	 * @param bool               $active
	 * @param bool               $delete
	 * @param string             $name
	 * @param float              $area
	 * @param string             $description
	 * @param int                $state
	 * @param int                $floor
	 * @param DtoExtra[]         $extras
	 * @param DtoRequest[]       $request
	 * @param DtoUser|null       $user
	 * @param DtoPropertyPrice[] $price
	 */

	public function __construct (int $id,int $userCreator,int $userModifier,string $dateCreated,string $dateModified,bool $active, bool $delete, string $name, float $area, string $description,
		int $state, int $floor, $extras, $request, $user, $price) {
		parent::__construct($id,$userCreator,$userModifier,$dateCreated,$dateModified,$active,$delete);
		$this->name = $name;
		$this->area = $area;
		$this->description = $description;
		$this->state = $state;
		$this->floor = $floor;
		$this->extras = $extras;
		$this->request = $request;
		$this->user = $user;
		$this->price = $price;
	}
}