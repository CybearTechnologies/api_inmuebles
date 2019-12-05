<?php
class CreatePropertyTypeCommand extends Command {
	private $_dao;
	private $_name;
	private $_command;
	private $_user;
	/**
	 * CreatePropertyTypeCommand constructor.
	 *
	 * @param PropertyType $propertyType
	 */
	public function __construct (PropertyType $propertyType) {
		$this->_dao = FactoryDao::createDaoPropertyType();
		$this->_command = FactoryCommand::createGetPropertyTypeByNameCommand($propertyType);
		$this->_name = strtolower($propertyType->getName());
		$this->_user = strtolower($propertyType->getUser());
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropetyTypeAlreadyExistException
	 * @throws PropertyTypeNotFoundException
	 */
	public function execute ():void {
		$this->_command->execute();
		if ($this->_command->return() != $this->_name)
			$this->setData($this->_dao->createPropertyType($this->_name,$this->_user));
		else
			Throw new PropetyTypeAlreadyExistException("La propiedad ya existe");
	}

	/**
	 * @return PropertyType
	 */
	public function return () {
		return $this->getData();
	}
}