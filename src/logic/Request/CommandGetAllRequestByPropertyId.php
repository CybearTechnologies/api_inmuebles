<?php
class CommandGetAllRequestByPropertyId extends Command {
	private $_property;

	/**
	 * CommandGetAllRequestByPropertyId constructor.
	 *
	 * @param $property
	 */
	public function __construct ($property) {
		$this->_dao = FactoryDao::createDaoRequest();
		$this->_property = $property;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllRequestByPropertyId($this->_property));
	}

	/**
	 * @return Request[]
	 */
	public function return () {
		return $this->getData();
	}
}