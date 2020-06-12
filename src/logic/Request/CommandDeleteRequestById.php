<?php
class CommandDeleteRequestById extends Command {
	private $_id;
	private $_user;
	private $_mapper;

	/**
	 * CommandDeleteRequestById constructor.
	 *
	 * @param int $id
	 * @param     $user
	 */
	public function __construct (int $id, int $user) {
		$this->_dao = FactoryDao::createDaoRequest();
		$this->_mapper = FactoryMapper::createMapperRequest();
		$this->_id = $id;
		$this->_user = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->_dao->deleteRequest($this->_id, $this->_user);
	}

	/**
	 * @return bool
	 */
	public function return () {
		return true;
	}
}