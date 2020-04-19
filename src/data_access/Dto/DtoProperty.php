<?php
class DtoProperty extends Dto {
	public $id;
	public $name;
	public $area;
	public $description;
	public $state;
	public $floor;
	public $extras;
	public $request;
	public $price;
	public $type;
	public $location;

	/**
	 * DtoProperty constructor.
	 *
	 * @param int                $id
	 * @param DtoUser|int        $userCreator
	 * @param DtoUser|int        $userModifier
	 * @param string             $dateCreated
	 * @param string             $dateModified
	 * @param bool               $active
	 * @param bool               $delete
	 * @param string             $name
	 * @param float              $area
	 * @param string             $description
	 * @param int                $state
	 * @param int                $floor
	 * @param int                $type
	 * @param DtoLocation|int    $location
	 * @param DtoPropertyExtra[] $extras
	 * @param DtoRequest[]       $request
	 * @param DtoPropertyPrice[] $price
	 */
	public function __construct (int $id, int $userCreator, int $userModifier, string $dateCreated,
		string $dateModified, bool $active, bool $delete, string $name, float $area, string $description,
		int $state, int $floor, int $type, int $location, $extras, $request, $price) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->id = $id;
		$this->name = $name;
		$this->area = $area;
		$this->description = $description;
		$this->state = $state;
		$this->floor = $floor;
		$this->extras = $extras;
		$this->request = $request;
		$this->price = $price;
		$this->type = $type;
		$this->location = $location;
	}
}