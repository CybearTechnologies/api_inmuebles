<?php
class GetUserByUsernameCommand extends Command {
	private $_dao;
	private $_entity;

	/**
	 * GetUserByUsernameCommand constructor.
	 *
	 * @param User $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoUser();
		$this->_entity = $entity;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getUserByUsername($this->_entity->getEmail()));
	}

	/**
	 * @return User
	 */
	public function return () {
		return $this->getData();
	}
}