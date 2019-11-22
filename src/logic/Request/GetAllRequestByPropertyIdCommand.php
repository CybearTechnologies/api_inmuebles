<?php
class GetAllRequestByPropertyIdCommand extends Command {
	private $_dao;

	/**
	 * GetAllRequestByPropertyIdCommand constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoRequest();
	}

	public function execute ():void {
		$this->setData();
	}

	public function return () {
		$this->getData();
	}
}