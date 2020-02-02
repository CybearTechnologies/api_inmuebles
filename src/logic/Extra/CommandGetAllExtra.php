<?php
class CommandGetAllExtra extends Command {
	/**
	 * CommandGetAllExtra constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoExtra();;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllExtra());
	}

	/**
	 * @return Extra[]
	 */
	public function return () {
		return ($this->getData());
	}
}