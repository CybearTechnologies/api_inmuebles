<?php
class CommandGetPropertyPriceById extends Command {
	/**
	 * CommandGetPropertyPriceById constructor.
	 *
	 * @param PropertyPrice $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoPropertyPrice($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws InvalidPropertyPriceException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getPropertyPriceById());
	}

	/**
	 * @return PropertyPrice
	 */
	public function return () {
		return $this->getData();
	}
}