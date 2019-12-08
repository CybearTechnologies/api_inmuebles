<?php
class Rating extends Entity {
    private $_score;
    private $_message;

	/**
	 * Rating constructor.
	 *
	 * @param int    $id
	 * @param float  $score
	 * @param string $message
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, float $score, string $message, bool $active, bool $delete, int $userCreator,
		int $userModifier, string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->_score = $score;
		$this->_message = $message;
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
}