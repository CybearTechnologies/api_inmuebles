<?php
class CommandDeleteExtraById extends Command {
	/**
	 * CommandDeleteExtraById constructor.
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
		$this->setData($this->_dao->deleteExtraById());
	}

	/**
	 * @return Extra
	 */
	public function return () {
		return $this->getData();
	}
}