<?php
class CommandCreateRequest extends Command {
	/**
	 * CommandCreateRequest constructor.
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
		$this->setData($this->_dao->createRequest());
	}

	/**
	 * @return Request
	 */
	public function return () {
		return $this->getData();
	}
}