<?php
class CommandGetAllRatingByUser extends Command {
	/**
	 * CommandGetAllRatingByUser constructor.
	 *
	 * @param User $user
	 */
	public function __construct ($user) {
		$this->_dao = FactoryDao::createDaoRating($user);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RatingNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllRatingByUser());
	}

	/**
	 * @return Rating[]
	 */
	public function return () {
		return $this->getData();
	}
}

