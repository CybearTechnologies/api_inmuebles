<?php
class GetPropertyPriceByPropertyIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetPropertyPriceByPropertyIdCommand constructor.
	 *
	 * @param $id
	 */
	public function __construct ($id) {
		$this->_id = $id;
		$this->_dao = FactoryDao::createDaoPropertyPrice();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyTypeNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getPriceByPropertyId($this->_id));
	}

	/**
	 * @return PropertyPrice
	 */
	public function return () {
		return $this->getData();
	}
}