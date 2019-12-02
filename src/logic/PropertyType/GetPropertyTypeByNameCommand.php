<?php
class GetPropertyTypeByNameCommand extends Command {
	private $_dao;
	private $_propertyName;

	/**
	 * GetPropertyTypeByNameCommand constructor.
	 *
	 * @param PropertyType $propertyType
	 */
	public function __construct (PropertyType $propertyType) {
		$this->_dao = FactoryDao::createDaoPropertyType();
		$this->_propertyName = strtolower($propertyType->getName());
	}

	/**
	 * @throws PropertyTypeNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getPropertyByName($this->_propertyName));
	}

	/**
	 * @return mixed
	 */
	public function return () {
		return $this->getData();
	}
}