<?php
class DeleteRequestByIdCommand extends Command {
	private $_dao;

	/**
	 * DeleteRequestByIdCommand constructor.
	 *
	 * @param Request $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoRequest($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->deleteRequestById());
	}

	/**
	 * @return Request
	 */
	public function return () {
		return $this->getData();
	}
}