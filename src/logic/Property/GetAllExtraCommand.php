<?php
class GetAllExtraCommand extends Command {
	private $_dao;

	/**
	 * GetAllExtraCommand constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoExtra();;
	}

	public function execute ():void {
		$this->setData($this->_dao->getAllExtra());
	}

	public function return () {
		return ($this->getData());
	}
}