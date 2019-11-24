<?php
class GetAgencyByIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetAgencyByIdCommand constructor.
	 *
	 * @param int $id
	 */
	public function __construct ($id) {
		$this->_id = $id;
		$this->_dao = FactoryDao::createDaoAgency();
	}

	/**
	 * @throws AgencyNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAgencyById($this->_id));
	}

	/**
	 * @return Agency
	 */
	public function return () {
		return $this->getData();
	}
}