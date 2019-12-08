<?php
class CreateExtraCommand extends Command {
	private $_dao;

	/**
	 * CreateExtraCommand constructor.
	 *
	 * @param Extra $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoExtra($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->createExtra());
	}

	/**
	 * @return Extra
	 */
	public function return () {
		return $this->getData();
	}
}