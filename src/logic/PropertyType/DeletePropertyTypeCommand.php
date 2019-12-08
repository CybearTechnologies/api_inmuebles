<?php
class DeletePropertyTypeCommand extends Command {
	private $_dao;

	/**
	 * DeletePropertyTypeCommand constructor.
	 *
	 * @param PropertyType $propertyType
	 */
	public function __construct (PropertyType $propertyType) {
		$this->_dao = FactoryDao::createDaoPropertyType($propertyType);
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->_dao->deletePropertyById();
	}

	public function return () {
	}
}