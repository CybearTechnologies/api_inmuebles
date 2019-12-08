<?php
class GetAllPropertyPriceCommand extends Command {
	/**
	 * GetAllPropertyPriceCommand constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoPropertyPrice();
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllPropertyPrice());
	}

	/**
	 * @return PropertyPrice[]
	 */
	public function return () {
		return $this->getData();
	}
}