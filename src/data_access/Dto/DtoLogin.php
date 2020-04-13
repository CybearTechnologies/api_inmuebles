<?php
class DtoLogin {
	public $user;
	public $token;

	/**
	 * DtoLogin constructor.
	 *
	 * @param DtoUser $user
	 * @param string $token
	 */
	public function __construct ($user, $token) {
		$this->user = $user;
		$this->token = $token;
	}
}