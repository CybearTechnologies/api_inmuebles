<?php
class CommandDeleteAccessById extends Command {
	private $_id;
	private $_user;

	/**
	 * CommandDeleteAccessById constructor.
	 *
	 * @param int $id
	 * @param int $user
	 */
	public function __construct (int $id, int $user) {
		$this->_dao = FactoryDao::createDaoAccess();
		$this->_id = $id;
		$this->_user = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws AccessNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->deleteAccessById($this->_id, $this->_user));
	}

	/**
	 * @return Access
	 */
	public function return ():Access {
		return $this->getData();
	}
}