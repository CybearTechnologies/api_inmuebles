<?php
class CommandDeleteAccessById extends Command {
	/**
	 * CommandDeleteAccessById constructor.
	 *
	 * @param Access $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoAccess($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->deleteAccessById());
	}

	/**
	 * @return Access
	 */
	public function return ():Access {
		return $this->getData();
	}
}