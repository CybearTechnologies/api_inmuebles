<?php
class DeletePropertyPriceByIdCommand extends Command {
	/**
	 * DeletePropertyPriceCommand constructor.
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
		$this->setData($this->_dao->deletePropertyPriceById());
	}

	/**
	 * @return PropertyPrice[]
	 */
	public function return () {
		return $this->getData();
	}
}