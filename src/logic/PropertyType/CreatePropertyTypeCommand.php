<?php
class CreatePropertyTypeCommand extends Command {
	private $_dao;
	private $_name;
	private $_command;
	/**
	 * CreatePropertyTypeCommand constructor.
	 *
	 * @param PropertyType $propertyType
	 */
	public function __construct (PropertyType $propertyType) {
		$this->_dao = FactoryDao::createDaoPropertyType($propertyType);
		$this->_command = FactoryCommand::createGetPropertyTypeByNameCommand($propertyType);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyTypeNotFoundException
	 * @throws PropetyTypeAlreadyExistException
	 */
	public function execute ():void {
		try {
			$this->_command->execute();
			Throw new PropetyTypeAlreadyExistException("Este tipo de propiedad ya existe");
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