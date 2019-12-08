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
	 * @throws PropetyTypeAlreadyExistException
	 * @throws PropertyTypeNotFoundException
	 */
	public function execute ():void {
		$this->_command->execute();
		if ($this->_command->return() != $this->_name)
			$this->setData($this->_dao->createPropertyType());
		else
			Throw new PropetyTypeAlreadyExistException("Este tipo de propiedad ya existe");
	}

	/**
	 * @return PropertyType
	 */
	public function return ():PropertyType {
		return $this->getData();
	}
}