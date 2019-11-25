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
	 * @param $id
	 * @param $name
	 * @param $area
	 * @param $description
	 * @param $publishDate
	 * @param $state
	 * @param $floor
	 * @param $extras
	 * @param $request
	 * @param $user
	 * @param $price
	 */
	public function __construct (int $id, $name, $area, $description, $publishDate,
		$state, $floor, $extras, $request, $user, $price) {
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