<?php
class CommandActiveProperty extends Command {
	private $_id;
	private $_user;

	/**
	 * CommandActiveProperty constructor.
	 *
	 * @param int $id
	 * @param int $user
	 */
	public function __construct ($id, $user) {
		$this->_dao = FactoryDao::createDaoProperty();
		$this->_id = $id;
		$this->_user = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->activeProperty($this->_id, $this->_user));
	}

	/***
	 * @return mixed
	 */
	public function return () {
		return $this->getData();
	}
}