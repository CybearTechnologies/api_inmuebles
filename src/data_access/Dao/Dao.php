<?php
/**
 * Generated by Houston
 * Date: 19-Nov-19
 * Time: 12:29 PM
 */
abstract class Dao {
	private $_database;

	/**
	 * Dao constructor.
	 */
	public function __construct () { $this->_database = Environment::database(); }

	/**
	 * @return PDO
	 */
	public function getDatabase ():PDO {
		return $this->_database;
	}

	/**
	 * @param $dbObjectArray
	 *
	 * @return array
	 */
	protected function extractAll ($dbObjectArray) {
		$array = [];
		foreach ($dbObjectArray as $dbObject)
			array_push($array, $this->extract($dbObject));

		return $array;
	}

	/**
	 * @param $dbObject
	 *
	 * @return mixed
	 */
	protected abstract function extract ($dbObject);
}