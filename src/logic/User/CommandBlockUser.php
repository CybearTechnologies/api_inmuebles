<?php
class CommandBlockUser extends Command {
	private $_id;
	private $_userModifier;

	/**
	 * CommandBlockUser constructor.
	 *
	 * @param $id
	 * @param $userModifier
	 */
	public function __construct ($id, $userModifier) {
		$this->_dao = FactoryDao::createDaoUser();
		$this->_id = $id;
		$this->_userModifier = $userModifier;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->blockUser($this->_id, $this->_userModifier));
	}

	/**
	 * @return User
	 */
	public function return () {
		return $this->getData();
	}
}