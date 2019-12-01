<?php
class Rating extends Entity
{
    private $_score;
    private $_message;
    private $_active;

	/**
	 * Rating constructor.
	 *
	 * @param int    $_id
	 * @param float  $_score
	 * @param string $_message
	 * @param bool   $_active
	 */
	public function __construct (int $_id, float $_score, string $_message, bool $_active)
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
	 * @return bool
	 */
	public function isActive ():bool {
		return $this->_active;
	}

	/**
	 * @param bool $active
	 */
	public function setActive (bool $active):void {
		$this->_active = $active;
	}
}