<?php
class DtoRating extends Dto
{
   public $score;
   public $message;
   public $active;
   public $user;


    /**
     * DtoRating constructor.
     * @param $id
     * @param $score
     * @param $message
     * @param $active
     * @param $user
     */
    public function __construct($id, $score, $message, $active, $user)
    {
        $this->id=$id;
        $this->score = $score;
        $this->message = $message;
        $this->active = $active;
        $this->user = $user;
    }
}