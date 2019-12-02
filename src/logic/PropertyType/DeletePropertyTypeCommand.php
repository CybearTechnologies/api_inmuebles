<?php
class DeletePropertyTypeCommand extends Command {
	private $_dao;
	private $_propertyType;

	/**
	 * DeletePropertyTypeCommand constructor.
	 *
	 * @param PropertyType $propertyType
	 */
	public function __construct (PropertyType $propertyType) {
		$this->_dao = FactoryDao::createDaoPropertyType();
		$this->_propertyType = $propertyType;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyTypeNotFoundException
	 */
	public function execute ():void {
		$this->_dao->deletePropertyById($this->_propertyType->getId());
	}

	public function return () {
	}
}