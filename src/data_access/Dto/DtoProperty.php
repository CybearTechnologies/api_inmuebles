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
	 * @param string             $name
	 * @param float              $area
	 * @param string             $description
	 * @param string             $publishDate
	 * @param int                $state
	 * @param int                $floor
	 * @param DtoExtra[]         $extras
	 * @param DtoRequest[]       $request
	 * @param DtoUser|null       $user
	 * @param DtoPropertyPrice[] $price
	 */
	public function __construct (int $id, string $name, float $area, string $description, string $publishDate,
		int $state, int $floor, $extras, $request, $user, $price) {
		$this->id = $id;
		$this->name = $name;
		$this->area = $area;
		$this->description = $description;
		$this->publishDate = $publishDate;
		$this->state = $state;
		$this->floor = $floor;
		$this->extras = $extras;
		$this->request = $request;
		$this->user = $user;
		$this->price = $price;
	}
}