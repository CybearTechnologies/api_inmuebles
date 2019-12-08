<?php
class GetAllAccessCommand extends Command {
	/**
	 * GetAllAccessCommand constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoAccess();
	}

	/**
	 * @throws AccessNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllAccess());
	}

	/**
	 * @return Access[]
	 */
	public function return () {
		return $this->getData();
	}
}