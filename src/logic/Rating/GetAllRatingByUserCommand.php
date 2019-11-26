<?php
class GetAllRatingByUserCommand extends Command {
	private $_dao;
	private $id;

	/**
	 * GetAllRatingByUserCommand constructor.
	 *
	 * @param int $id
	 */
	public function __construct (int $id) {
		$this->_dao = FactoryDao::createDaoRating();
		$this->id = $id;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RatingNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllRatingByUser($this->id));
	}

	/**
	 * @return Rating[]
	 */
	public function return () {
		return $this->getData();
	}
}

