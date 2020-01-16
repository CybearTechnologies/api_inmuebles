<?php
class CreateRatingByUserIdCommand extends Command {
	/**
	 * CreateRatingByUserIdCommand constructor.
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
		$this->setData($this->_dao->createRatingByUserId());
	}

	/**
	 * @return Rating
	 */
	public function return ():Rating {
		return $this->getData();
	}
}