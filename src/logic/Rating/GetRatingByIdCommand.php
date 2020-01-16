<?php
class GetRatingByIdCommand extends Command {
	/**
	 * GetRatingByIdCommand constructor.
	 *
	 * @param Rating $rating
	 */
	public function __construct ($rating) {
		$this->_dao = FactoryDao::createDaoRating($rating);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RatingNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getRatingById());
	}

	/**
	 * @return Rating
	 */
	public function return ():Rating {
		return $this->getData();
	}
}

