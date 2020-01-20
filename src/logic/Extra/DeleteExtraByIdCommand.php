<?php
class DeleteExtraByIdCommand extends Command {
	/**
	 * DeleteExtraByIdCommand constructor.
	 *
	 * @param Extra $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoExtra($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
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