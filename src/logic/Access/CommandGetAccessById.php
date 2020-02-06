<?php
class CommandGetAccessById extends Command {
	/**
	 * CommandGetAccessById constructor.
	 *
	 * @param Access $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoAccess($entity);
	}

	/**
	 * @throws AccessNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAccessById());
	}

	/**
	 * @return Access
	 */
	public function return ():Access {
		return $this->getData();
	}
}