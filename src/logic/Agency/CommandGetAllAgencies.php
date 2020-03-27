<?php
class CommandGetAllAgencies extends Command {
	private $_builder;

	/**
	 * CommandGetAllAgencies constructor.
	 */
	public function __construct () {
		$this->_builder = new ListAgencyBuilder();
	}

	/**
	 * @throws AgencyNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$dtoAgency = $this->_builder
									->getAll()
									->clean()
									->build();
		$this->setData($dtoAgency);
	}

	/**
	 * @return Agency[]
	 */
	public function return () {
		return $this->getData();
	}
}