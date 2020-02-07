<?php
class CommandCreateRating extends Command {
	/**
	 * CommandCreateRating constructor.
	 *
	 * @param Rating $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoRating($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->createRating());
	}

	/**
	 * @return Rating
	 */
	public function return ():Rating {
		return $this->getData();
	}
}