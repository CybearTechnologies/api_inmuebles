<?php
class CommandCreatePropertyPrice extends Command {
	private $_price;
	private $_propertyId;
	private $_creator;

	/**
	 * CommandCreatePropertyPrice constructor.
	 *
	 * @param     $price
	 * @param int $propertyId
	 * @param int $creator
	 */
	public function __construct ($price, int $propertyId, int $creator) {
		$this->_dao = FactoryDao::createDaoPropertyPrice();
		$this->_price = $price;
		$this->_propertyId = $propertyId;
		$this->_creator = $creator;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->createPropertyPrice($this->_price, $this->_propertyId, $this->_creator));
	}

	/**
	 * @return PropertyPrice
	 */
	public function return () {
		return $this->getData();
	}
}