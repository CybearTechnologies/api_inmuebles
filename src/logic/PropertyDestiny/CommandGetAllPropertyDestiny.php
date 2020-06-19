<?php
class CommandGetAllPropertyDestiny extends Command {
	private $_mapper;
	/**
	 * CommandGetAllPropertyDestiny constructor.
	 */
	public function __construct () {
		$this->_dao=FactoryDao::createDaoPropertyDestiny();
		$this->_mapper= FactoryMapper::createMapperPropertyDestiny();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyDestinyNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_mapper->fromEntityArrayToDtoArray($this->_dao->getAllPropertyDestiny()));
	}

	/**
	 * @return DtoPropertyDestiny[]
	 */
	public function return () {
		return $this->getData();
	}
}