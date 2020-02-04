<?php
class CommandGetAllRequestByPropertyId extends Command {
	/**
	 * CommandGetAllRequestByPropertyId constructor.
	 *
	 * @param Property $property
	 */
	public function __construct ($property) {
		$this->_dao = FactoryDao::createDaoRequest($property);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllRequestByPropertyId());
	}

	/**
	 * @return Request[]
	 */
	public function return () {
		return $this->getData();
	}
}