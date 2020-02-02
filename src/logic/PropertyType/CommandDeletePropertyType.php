<?php
class CommandDeletePropertyType extends Command {
	/**
	 * CommandDeletePropertyType constructor.
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
		$this->setData($this->_dao->deletePropertyById());
	}

	/**
	 * @return PropertyType
	 */
	public function return () {
		return $this->getData();
	}
}