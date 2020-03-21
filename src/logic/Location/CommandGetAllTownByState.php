<?php
class CommandGetAllTownByState extends Command {
	private $_mapperLocation;
	private $_id;

	/**
	 * CommandGetAllTownByState constructor.
	 */
	public function __construct ($id) {
		$this->_dao = FactoryDao::createDaoLocation();
		$this->_mapperLocation = FactoryMapper::createMapperLocation();
		$this->_id = $id;
	}

	public function execute ():void {
		$dtoLocation = $this->_mapperLocation->fromEntityArrayToDtoArray($this->_dao->getLocationByState($this->_id));
		$this->setData($dtoLocation);
	}

	/**
	 * @return DtoLocation[]
	 */
	public function return () {
		return $this->getData();
	}
}