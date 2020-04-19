<?php
class CommandGetPropertyPriceByPropertyId extends Command {
	private $_mapperPropertyPrice;
	private $_property;

	/**
	 * CommandGetPropertyPriceByPropertyId constructor.
	 *
	 * @param int $property
	 */
	public function __construct ($property) {
		$this->_dao = FactoryDao::createDaoPropertyPrice($property);
		$this->_mapperPropertyPrice = FactoryMapper::createMapperPropertyPrice();
		$this->_property = $property;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws InvalidPropertyPriceException
	 */
	public function execute ():void {
		$dtoPropertyPrice = $this->_mapperPropertyPrice->fromEntityArrayToDtoArray($this->_dao->getPropertyPriceByPropertyId($this->_property));
		$this->setData($dtoPropertyPrice);
	}

	/**
	 * @return DtoPropertyPrice[]
	 */
	public function return () {
		return $this->getData();
	}
}