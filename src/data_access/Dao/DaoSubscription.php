<?php
class DaoSubscription extends Dao {
	private $_entity;
	private const QUERY_CREATE = "CALL insertFavorites(:property,:user,:dateCreated)";

	/**
	 * @param $dbObject
	 *
	 * @return mixed
	 */
	protected function extract ($dbObject) {
		// TODO: Implement extract() method.
	}
}