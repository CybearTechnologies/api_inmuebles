<?php
class DaoRolAccess extends Dao {
	private const QUERY_INSERT = "CALL insertAccessRol(:rol,:access,:user,dateCreated)";
	private const QUERY_GET_ACCESS_BY_ROL = "CALL getAccessByRol(:id)";
	private const QUERY_DEACTIVATE = "CALL deactivateRolAccessById(:id,:user,:dateModified)";
	private const QUERY_ACTIVATE = "CALL activateRolAccessById(:id,:user,:dateModified";
	private $_entity;

	//TODO termimnar el dao
	/**
	 * DaoRolAccess constructor.
	 *
	 * @param RolAccess $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}

	/**
	 * @inheritDoc
	 */
	protected function extract ($dbObject) {
		// TODO: Implement extract() method.
	}
}