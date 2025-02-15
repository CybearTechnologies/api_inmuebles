<?php
/**
 * Generated by Houston
 * Date: 19-Nov-19
 * Time: 12:29 PM
 */
require_once __DIR__ . "/../vendor/autoload.php";
class Environment {
	//	Site settings
	private const BASE_URL = "http://api.cybear.io/";
	private const BASE_FRONT_URL = "http://buscamatch.cybear.io/";
	private const SITE_KEY = "coronavirus";
	//	Database connections settings
		private const HOST = "localhost";
		private const DATABASE = "inmobiliaria";
		private const USERNAME = "root";
		private const PASSWORD = "";
	/*	private const HOST = "160.153.54.65";
		private const DATABASE = "buscamatch";
		private const USERNAME = "buscaRoot";
		private const PASSWORD = "dIo{xi5miupN";*/

	/**
	 * @return PDO
	 */
	public static function database ():PDO {
		try {
			$PDO = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DATABASE, self::USERNAME,
				self::PASSWORD);
			$PDO->exec("set names utf8");
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $PDO;
		}
		catch (Exception $exception) {
			Logger::exception($exception, Logger::ERROR);
			echo $exception->getMessage();
		}

		return null;
	}

	/**
	 * @return string
	 */
	public static function baseURL ():string {
		return self::BASE_URL;
	}

	/**
	 * @return string
	 */
	public static function siteKey ():string {
		return self::SITE_KEY;
	}

	/**
	 * @return string
	 */
	public static function baseFrontURL ():string {
		return self::BASE_FRONT_URL;
	}
}
