<?php
class CommandGetPropertyPriceByPropertyId extends Command {
	private $_property;

	/**
	 * CommandGetPropertyPriceByPropertyId constructor.
	 *
	 * @param int $property
	 */
	public function __construct (int $property) {
		$this->_dao = FactoryDao::createDaoPropertyPrice();
		$this->_property = $property;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws InvalidPropertyPriceException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getPropertyPriceByPropertyId($this->_property));
	}

	/**
	 * @return PropertyPrice[]
	 */
	public function return () {
		return $this->getData();
	}
}