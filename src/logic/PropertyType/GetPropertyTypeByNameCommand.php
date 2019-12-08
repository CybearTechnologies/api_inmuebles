<?php
class GetPropertyTypeByNameCommand extends Command {
	/**
	 * GetPropertyTypeByNameCommand constructor.
	 *
	 * @param PropertyType $propertyType
	 */
	public function __construct (PropertyType $propertyType) {
		$this->_dao = FactoryDao::createDaoPropertyType($propertyType);
	}

	/**
	 * @throws PropertyTypeNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getPropertyByName());
	}

	/**
	 * @return PropertyType
	 */
	public function return ():PropertyType {
		return $this->getData();
	}
}