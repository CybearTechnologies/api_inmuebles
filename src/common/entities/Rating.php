<?php
class Rating extends Entity
{
    private $_score;
    private $_message;
    private $_active;

    /**
     * Rating constructor.
     * @param $_id
     * @param $_score
     * @param $_message
     * @param $_active
     */
    public function __construct($_id, $_score, $_message, $_active)
    {
        $this->setId($_id);
        $this->_score = $_score;
        $this->_message = $_message;
        $this->_active = $_active;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->_score;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score): void
    {
        $this->_score = $score;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->_message = $message;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->_active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active): void
    {
        $this->_active = $active;
    }




}