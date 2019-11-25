<?php
class GetAllRatingByUserCommand extends Command {
	private $_dao;
	private $id;

	/**
	 * GetAllRatingByUserCommand constructor.
	 *
	 * @param $id
	 */
	public function __construct ($id) {
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

