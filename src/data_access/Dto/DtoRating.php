<?php
class DtoRating extends Dto
{
   public $score;
   public $message;
   public $active;
   public $user;

	/**
	 * DtoRating constructor.
	 *
	 * @param int    $id
	 * @param float  $score
	 * @param string $message
	 * @param bool   $active
	 * @param User   $user
	 */
	public function __construct (int $id, float $score, string $message, bool $active, User $user) {
        $this->id=$id;
        $this->score = $score;
        $this->message = $message;
        $this->active = $active;
        $this->user = $user;
    }
}