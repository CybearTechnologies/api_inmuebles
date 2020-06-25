<?php
class CommandCreateSeat extends Command {
	private $_command;
	private $_name;
	private $_rif;
	private $_location;
	private $_agency;
	private $_user;

	/**
	 * CommandCreateSeat constructor.
	 *
	 * @param $name
	 * @param $rif
	 * @param $location
	 * @param $agency
	 */
	public function __construct ($name, $rif, $location, $agency, $user) {
		$this->_dao = FactoryDao::createDaoSeat();
		$this->_name = $name;
		$this->_rif = $rif;
		$this->_location = $location;
		$this->_agency = $agency;
		$this->_user = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->createSeat($this->_name, $this->_rif, $this->_location, $this->_agency, $this->_user));
	}

	/**
	 * @return Seat
	 */
	public function return () {
		return $this->getData();
	}
}