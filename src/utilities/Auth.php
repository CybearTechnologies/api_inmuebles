<?php

use Firebase\JWT\JWT;

class Auth {
	private static $encrypt = ['HS256'];

	/**
	 * @param mixed  $data
	 * @param string $encryptKey
	 *
	 * @return string
	 */
	public static function generateJWT ($data, $encryptKey) {
		$time = time();
		$token = array (
			'iat' => $time,
			'exp' => $time + (12 * 60 * 60),
			'aud' => self::Aud(),
			'data' => $data
		);

		return JWT::encode($token, $encryptKey);
	}

	/**
	 * @param string $token
	 * @param string $encryptKey
	 *
	 * @return mixed
	 * @throws InvalidJWTException
	 */
	public static function getData ($token, $encryptKey) {
		if (empty($token))
			Throw new InvalidJWTException("Invalid token supplied.");
		$jwt = JWT::decode($token, $encryptKey, self::$encrypt);
		if ($jwt->aud !== self::aud())
			Throw new InvalidJWTException("Invalid user logged in.");

		return $jwt;
	}

	/**
	 * @return string
	 */
	private static function aud () {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			$aud = $_SERVER['HTTP_CLIENT_IP'];
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			$aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$aud = $_SERVER['REMOTE_ADDR'];
		$aud .= @$_SERVER['HTTP_USER_AGENT'];
		$aud .= gethostname();

		return sha1($aud . Environment::siteKey());
	}
}