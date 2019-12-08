<?php
class DaoUser extends Dao {
	private const QUERY_CREATE = "";
	private const QUERY_GET_ALL = "";
	private const QUERY_GET_BY_ID = "";
	private $_user;

	/**
	 * DaoUser constructor.
	 *
	 * @param User $user
	 */
	public function __construct ($user) {
		parent::__construct();
		$this->_user = $user;
	}

	/**
	 * @param $dbObject
	 *
	 * @return mixed
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createUser($dbObject->id, $dbObject->firstname, $dbObject->lastname, $dbObject->address,
			$dbObject->email, $dbObject->password, $dbObject->delete, $dbObject->blocked);
	}
}