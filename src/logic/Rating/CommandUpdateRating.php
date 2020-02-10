<?php
class CommandUpdateRating extends Command {
	/**
	 * CommandUpdateRating constructor.
	 *
	 * @param Rating $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoRating($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RatingNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->updateRatingById());
	}

	/**
	 * @return Rating
	 */
	public function return () {
		return $this->getData();
	}
}