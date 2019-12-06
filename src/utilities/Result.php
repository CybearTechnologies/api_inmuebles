<?php
/**
 * Generated by Houston
 * Date: 19-Nov-19
 * Time: 12:29 PM
 */
class Result {
	public $success;
	public $data;
	public $errors;

	/**
	 * Result constructor.
	 *
	 * @param bool  $success
	 * @param array $data
	 * @param array $errors
	 */
	public function __construct ($success = true, $data = [], $errors = []) {
		$this->success = $success;
		$this->data = $data;
		$this->errors = $errors;
	}

	/**
	 * @param int $responseCode
	 */
	public static function setResponse ($responseCode = 200) {
		http_response_code($responseCode);
	}
}