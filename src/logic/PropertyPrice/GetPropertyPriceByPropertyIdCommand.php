<?php
class GetPropertyPriceByPropertyIdCommand extends Command {
	private $_dao;

	/**
	 * GetPropertyPriceByPropertyIdCommand constructor.
	 *
	 * @param Property $property
	 */
	public function __construct ($property) {
		$this->_dao = FactoryDao::createDaoPropertyPrice($property);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws InvalidPropertyPriceException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getPriceByPropertyId());
	}

	/**
	 * @return PropertyPrice[]
	 */
	public function return () {
		return $this->getData();
	}
}