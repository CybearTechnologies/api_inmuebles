<?php
class GetAllExtraCommand extends Command {
	private $_dao;

	public function execute ():void {
		$this->_dao=FactoryDao::createDaoExtra();
		$this->setData($this->_dao->getAllExtra());
	}

	public function return () {
		return($this->getData());
	}
}