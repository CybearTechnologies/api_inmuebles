<?php
class GetRatingByIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetRatingByIdCommand constructor.
	 */
	public function __construct ($_id) {
		$this->_dao = FactoryDao::createDaoRating();
		$this->_id = $_id;
	}

	public function execute ():void {
		$this->setData($this->_dao->getRatingById($this->_id));
	}

	public function return () {
		return $this->getData();
	}
}

