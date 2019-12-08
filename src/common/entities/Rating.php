<?php
class Rating extends Entity {
    private $_score;
    private $_message;
    private $_active;

	/**
	 * Rating constructor.
	 *
	 * @param int    $id
	 * @param float  $score
	 * @param string $message
	 * @param bool   $active
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, float $score, string $message, bool $active, int $userCreator,
		int $userModifier, string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified);
		$this->_score = $score;
		$this->_message = $message;
		$this->_active = $active;
    }

	/**
	 * @return float
	 */
	public function getScore ():float {
		return $this->_score;
	}

	/**
	 * @param float $score
	 */
	public function setScore (float $score):void {
		$this->_score = $score;
	}

	/**
	 * @return string
	 */
	public function getMessage ():string {
		return $this->_message;
	}

	/**
	 * @param string $message
	 */
	public function setMessage (string $message):void {
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