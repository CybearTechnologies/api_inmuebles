<?php
class GetPropertyTypeByIdCommand extends Command {
	/**
	 * GetPropertyTypeByIdCommand constructor.
	 *
	 * @param PropertyType $propertyType
	 */
	public function __construct ($propertyType) {
		$this->_dao = FactoryDao::createDaoPropertyType($propertyType);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyTypeNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getPropertyTypeById());
	}

	/**
	 * @return PropertyType
	 */
	public function return ():PropertyType {
		return $this->getData();
	}
}