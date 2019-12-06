<?php
class DtoRating extends Dto
{
   public $score;
   public $message;
   public $active;

	/**
	 * DtoRating constructor.
	 *
	 * @param int    $id
	 * @param float  $score
	 * @param string $message
	 * @param bool   $active
	 */
	public function __construct (int $id, float $score, string $message, bool $active) {
        $this->id=$id;
        $this->score = $score;
        $this->message = $message;
        $this->active = $active;
    }
}