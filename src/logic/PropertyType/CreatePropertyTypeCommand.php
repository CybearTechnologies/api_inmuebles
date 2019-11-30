<?php
class CreatePropertyTypeCommand extends Command {
	private $_dao;
	private $_name;

	/**
	 * CreatePropertyTypeCommand constructor.
	 *
	 * @param PropertyType $propertyType
	 */
	public function __construct (PropertyType $propertyType) {
		$this->_dao = FactoryDao::createDaoPropertyType();
		$this->_name = $propertyType->getName();
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->createPropertyType($this->_name));
	}

	/**
	 * @return PropertyType
	 */
	public function return () {
		return $this->getData();
	}
}