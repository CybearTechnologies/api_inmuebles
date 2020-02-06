<?php
class CommandCreateRatingByUserId extends Command {
	/**
	 * CommandCreateRatingByUserId constructor.
	 *
	 * @param User $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoRating($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RatingNotFoundException
	 */
	public function execute ():void {
		//TODO FALTA ESTE DAO
		$this->setData($this->_dao->createRatingByUserId());
	}

	/**
	 * @return Rating
	 */
	public function return ():Rating {
		return $this->getData();
	}
}