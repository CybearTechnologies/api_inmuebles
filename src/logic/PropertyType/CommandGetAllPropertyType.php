<?php
class CommandGetAllPropertyType extends Command {
	/**
	 * CommandGetAllPropertyType constructor.
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

	/**
	 * @return PropertyType[]
	 */
	public function return () {
		return $this->getData();
	}
}