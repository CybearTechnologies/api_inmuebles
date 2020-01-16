<?php
class GetLocationByIdCommand extends Command {
	/**
	 * GetLocationByIdCommand constructor.
	 *
	 * @param Location $location
	 */
	public function __construct ($location) {
		$this->_dao = FactoryDao::createDaoLocation($location);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getLocationById());
	}

	/**
	 * @return Location
	 */
	public function return () {
		return $this->getData();
	}
}
