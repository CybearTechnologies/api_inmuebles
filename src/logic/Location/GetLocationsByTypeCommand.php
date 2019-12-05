<?php
class GetLocationsByTypeCommand extends Command {
	private $_dao;

    /**
     * GetLocationsByTypeCommand constructor.
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
		$this->setData($this->_dao->getLocationsByType());
	}

    /**
     * @return Location[]
     */
	public function return () {
		return $this->getData();
	}
}