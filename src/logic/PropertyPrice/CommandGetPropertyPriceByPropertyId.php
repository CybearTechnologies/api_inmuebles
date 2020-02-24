<?php
class CommandGetPropertyPriceByPropertyId extends Command {
	private $_property;

	/**
	 * CommandGetPropertyPriceByPropertyId constructor.
	 *
	 * @param PropertyPrice $propertyPrice
	 */
	public function __construct ($propertyPrice) {
		$this->_dao = FactoryDao::createDaoPropertyPrice($propertyPrice);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws InvalidPropertyPriceException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getPropertyPriceByPropertyId());
	}

	/**
	 * @return PropertyPrice[]
	 */
	public function return () {
		return $this->getData();
	}
}