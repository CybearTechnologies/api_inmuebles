<?php
class CommandCreatePropertyType extends Command {
	private $_command;

	/**
	 * CommandCreatePropertyType constructor.
	 *
	 * @param PropertyType $propertyType
	 */
	public function __construct (PropertyType $propertyType) {
		$this->_dao = FactoryDao::createDaoPropertyType($propertyType);
		$this->_command = FactoryCommand::createCommandGetPropertyTypeByName($propertyType);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropetyTypeAlreadyExistException
	 */
	public function execute ():void {
		try {
			$this->_command->execute();
			Throw new PropetyTypeAlreadyExistException("Property already exist");
		}
		catch (PropertyTypeNotFoundException $exception) {
			$this->setData($this->_dao->createPropertyType());
		}
	}

	/**
	 * @return PropertyType
	 */
	public function return ():PropertyType {
		return $this->getData();
	}
}