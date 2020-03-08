<?php
class CommandCreatePropertyExtra extends Command {
	private $_propertyExtra;

	/**
	 * CommandCretePropertyExtra constructor.
	 *
	 * @param PropertyExtra[] $propertyExtra
	 */
	public function __construct ($propertyExtra) {
		$this->_dao = FactoryDao::createDaoPropertyExtra();
		$this->_propertyExtra = $propertyExtra;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyExtraNotFoundException
	 */
	public function execute ():void {
		$extras = $this->_propertyExtra;
		for ($i = 0; $i < count($extras); $i++) {
			$this->_dao->setEntity($extras[$i]);
			$this->_dao->createPropertyExtra();
		}
		$this->setData($this->_dao->getPropertyExtraByPropertyId());
	}

	/**
	 * @return PropertyExtra[]
	 */
	public function return () {
		return $this->getData();
	}
}