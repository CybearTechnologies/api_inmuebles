<?php
class PasswordToken extends Entity {
	private $_token;

	public function __construct (int $id, string $token,int $userCreator, int $userModifier,
		string $dateCreated, string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->_token = $token;
	}

	/**
	 * @return string
	 */
	public function getToken ():string {
		return $this->_token;
	}

	/**
	 * @param string $token
	 */
	public function setToken (string $token):void {
		$this->_token = $token;
	}



}