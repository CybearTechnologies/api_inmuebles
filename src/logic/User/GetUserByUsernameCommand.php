<?php
class GetUserByUsernameCommand extends Command {
	private $_entity;

	/**
	 * GetUserByUsernameCommand constructor.
	 *
	 * @param User $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoUser($entity);
		$this->_entity = $entity;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 * @throws MultipleUserException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getUserByUsername());
	}

	/**
	 * @return User
	 */
	public function return () {
		return $this->getData();
	}
}