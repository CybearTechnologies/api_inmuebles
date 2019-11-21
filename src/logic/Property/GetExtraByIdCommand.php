<?php
class GetExtraByIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetExtraByIdCommand constructor.
	 *
	 * @param $_id
	 */
	public function __construct ($_id) {
		$this->_id = $_id;
	}

	public function execute ():void {
		$this->_dao=FactoryDao::createDaoExtra();
		$this->setData($this->_dao->getExtraById($this->_id));
	}

	public function return () {
		return $this->getData();
	}
}