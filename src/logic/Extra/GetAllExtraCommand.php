<?php
class GetAllExtraCommand extends Command {
	/**
	 * GetAllExtraCommand constructor.
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