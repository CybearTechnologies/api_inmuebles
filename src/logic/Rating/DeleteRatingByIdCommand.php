<?php
class DeleteRatingByIdCommand extends Command {
	private $_dao;

	/**
	 * DeleteRatingByIdCommand constructor.
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
		$this->setData($this->_dao->deleteRatingById());
	}

	/**
	 * @return Rating
	 */
	public function return ():Rating {
		return $this->getData();
	}
}