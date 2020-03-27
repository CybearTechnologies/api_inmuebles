<?php
class CommandGetAgencyById extends Command {
	private $_agencyBuilder;
	private $_id;

	/**
	 * CommandGetAgencyById constructor.
	 *
	 * @param int $id
	 */
	public function __construct ($id) {
		$this->_dao = FactoryDao::createDaoAgency();
		$this->_agencyBuilder = new AgencyBuilder();
		$this->_id = $id;
	}

	/**
	 * @throws AgencyNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$dtoAgency = $this->_agencyBuilder
									->getMinimumById($this->_id)
									->withSeats()
									->clean()
									->build();
		$this->setData($dtoAgency);
	}

	/**
	 * @return DtoAgency
	 */
	public function return () {
		return $this->getData();
	}
}