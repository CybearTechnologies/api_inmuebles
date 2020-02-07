<?php
class DtoRating extends Dto {
	public $score;
	public $message;
	public $target;

	/**
	 * DtoRating constructor.
	 *
	 * @param int    $id
	 * @param float  $score
	 * @param string $message
	 * @param int    $target
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 */
	public function __construct (int $id, float $score, string $message, int $target, int $userCreator,
		int $userModifier,
		string $dateCreated,
		string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->score = $score;
		$this->message = $message;
		$this->target = $target;
	}
}