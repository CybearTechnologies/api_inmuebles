<?php
class GetPropertyTypeByIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetPropertyTypeByIdCommand constructor.
	 *
	 * @param $id
	 */
	public function __construct ($id) {
		$this->_id = $id;
		$this->_dao = FactoryDao::createDaoPropertyType();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyTypeNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getPropertyById($this->_id));
	}

	/**
	 * @return PropertyType
	 */
	public function return ():PropertyType {
		return $this->getData();
	}
}