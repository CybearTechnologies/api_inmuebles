<?php
class GetAllPropertyCommand extends Command {
	private $_dao;

	/**
	 * GetAllPropertyCommand constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoProperty();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllProperty());
	}

	public function return () {
		return $this->getData();
	}
}