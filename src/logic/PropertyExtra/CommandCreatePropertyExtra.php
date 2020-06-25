<?php
class CommandCreatePropertyExtra extends Command {
	private $_id;
	private $_amount;
	private $_property;
	private $_creator;

	/**
	 * CommandCretePropertyExtra constructor.
	 *
	 * @param int $id
	 * @param int $amount
	 * @param int $property
	 * @param int $creator
	 */
	public function __construct (int $id, int $amount, int $property, int $creator) {
		$this->_dao = FactoryDao::createDaoPropertyExtra();
		$this->_id = $id;
		$this->_amount = $amount;
		$this->_property = $property;
		$this->_creator = $creator;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$propertyExtra = $this->_dao->createPropertyExtra($this->_id, $this->_amount, $this->_property,
			$this->_creator);
		$this->setData($propertyExtra);
	}

	/**
	 * @return PropertyExtra
	 */
	public function return () {
		return $this->getData();
	}
}