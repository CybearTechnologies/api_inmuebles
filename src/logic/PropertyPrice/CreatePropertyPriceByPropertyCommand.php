<?php
class CreatePropertyPriceByPropertyCommand extends Command {
	private $_dao;

	/**
	 * CreatePropertyPriceByProperty constructor.
	 *
	 * @param Property $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoPropertyPrice($entity);
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