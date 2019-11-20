<?php
class GetAllPropertyTypeCommand extends Command {
	private $_dao;

	/**
	 * GetAllPropertyTypeCommand constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoPropertyType();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyTypeNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllPropertyTypes());
	}

	public function return () {
		return $this->getData();
	}
}