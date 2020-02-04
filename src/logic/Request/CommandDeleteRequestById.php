<?php
class CommandDeleteRequestById extends Command {
	/**
	 * CommandDeleteRequestById constructor.
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
		//TODO	falta este metodo en el dao
		$this->setData($this->_dao->deleteRequestById());
	}

	/**
	 * @return Request
	 */
	public function return () {
		return $this->getData();
	}
}