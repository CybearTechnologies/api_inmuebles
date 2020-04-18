<?php
class CommandInactiveExtra extends Command {
	private $_extra;
	private $_user;

	/**
	 * CommandActiveExtra constructor.
	 *
	 * @param int $extra
	 * @param int $user
	 */
	public function __construct ($extra, $user) {
		$this->_dao = FactoryDao::createDaoExtra();
		$this->_extra = $extra;
		$this->_user = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->inactiveExtraById($this->_extra, $this->_user));
	}

	/***
	 * @return mixed
	 */
	public function return () {
		return $this->getData();
	}
}