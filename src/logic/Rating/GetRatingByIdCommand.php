<?php
class GetRatingByIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetRatingByIdCommand constructor.
	 *
	 * @param int $_id
	 */
	public function __construct (int $_id) {
		$this->_dao = FactoryDao::createDaoRating();
		$this->_id = $_id;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RatingNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getRatingById($this->_id));
	}

	public function return () {
		return $this->getData();
	}
}

