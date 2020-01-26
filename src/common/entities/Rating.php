<?php
class Rating extends Entity {
    private $_score;
    private $_message;
    private $_userTarget;

	/**
	 * Rating constructor.
	 *
	 * @param int    $id
	 * @param float  $score
	 * @param string $message
	 * @param int    $user
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, float $score, string $message, int $user,bool $active, bool $delete, int $userCreator,
		int $userModifier, string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->_score = $score;
		$this->_message = $message;
		$this->_userTarget = $user;
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
	 * @return int
	 */
	public function getUserTarget ():int {
		return $this->_userTarget;
	}

	/**
	 * @param int $userTarget
	 */
	public function setUserTarget (int $userTarget):void {
		$this->_userTarget = $userTarget;
	}



}