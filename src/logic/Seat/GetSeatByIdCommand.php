<?php
class GetSeatByIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetSeatByIdCommand constructor.
	 *
	 * @param $_id
	 */
	public function __construct ($_id) {
		$this->_dao = FactoryDao::createDaoSeat();
		$this->_id = $_id;
	}

	public function execute ():void {
		$this->setData($this->_dao->getSeatById($this->_id));
	}

	public function return () {
		return $this->getData();
	}
}