<?php
class CreatePropertyTypeCommand extends Command {
	private $_dao;
	private $_propertyType;

	/**
	 * CreatePropertyTypeCommand constructor.
	 *
	 * @param PropertyType $propertyType
	 */
	public function __construct ($propertyType) {
		$this->_dao = FactoryDao::createDaoPropertyType();
		$this->_propertyType = $propertyType;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->createPropertyType($this->_propertyType));
	}

	/**
	 * @return PropertyType
	 */
	public function return () {
		return $this->getData();
	}
}