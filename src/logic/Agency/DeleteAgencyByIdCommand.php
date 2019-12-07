<?php
class DeleteAgencyByIdCommand extends Command {
	private $_dao;

	/**
	 * DeleteAgencyByIdCommand constructor.
	 *
	 * @param Agency $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoAgency($entity);
	}

	public function execute ():void {
		$this->setData($this->_dao->deleteAgencyById());
	}

	/**
	 * @return Agency
	 */
	public function return () {
		return $this->getData();
	}
}