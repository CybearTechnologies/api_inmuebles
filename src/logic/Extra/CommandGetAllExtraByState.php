<?php
class CommandGetAllExtraByState extends Command {
	/**
	 * CommandGetAllExtra constructor.
	 *
	 * @param Extra $extra
	 */
	public function __construct ($extra) {
		$this->_dao = FactoryDao::createDaoExtra($extra);;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllExtraByState());
	}

	/**
	 * @return Extra[]
	 */
	public function return () {
		return ($this->getData());
	}
}