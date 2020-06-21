<?php
class CommandGetAllPropertyAdmin extends Command {
	private $_loggedUser;
	private $_mapperProperty;

	/**
	 * CommandGetAllPropertyAdmin constructor.
	 *
	 * @param $user
	 */
	public function __construct ($user) {
		$this->_dao = FactoryDao::createDaoProperty();
		$this->_mapperProperty = FactoryMapper::createMapperProperty();
		$this->_loggedUser = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_mapperProperty->fromEntityArrayToDtoArray($this->_dao->getAllPropertiesAdmin($this->_loggedUser)));
	}

	/**
	 * @return mixed
	 */
	public function return () {
		return $this->getData();
	}
}