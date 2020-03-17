<?php
class CommandGetLocationById extends Command {
	private $_mapperLocation;
	/**
	 * CommandGetLocationById constructor.
	 *
	 * @param Location $location
	 */
	public function __construct ($location) {
		$this->_dao = FactoryDao::createDaoLocation($location);
		$this->_mapperLocation = FactoryMapper::createMapperLocation();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 */
	public function execute ():void {
		$dtoLocation = $this->_mapperLocation->fromEntityToDto($this->_dao->getLocationById());
		$this->setData($dtoLocation);
	}

	/**
	 * @return DtoLocation
	 */
	public function return () {
		return $this->getData();
	}
}
