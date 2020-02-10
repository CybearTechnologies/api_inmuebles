<?php
class CommandActiveRating extends Command {
	/**
	 * CommandActiveRating constructor.
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
		$this->setData($this->_dao->activeRatingById());
	}

	/**
	 * @return Rating
	 */
	public function return () {
		return $this->getData();
	}
}