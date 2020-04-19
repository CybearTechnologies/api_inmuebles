<?php
class AccessBuilder extends Builder {
	private $_mapperAccess;

	/**
	 * AccessBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoAccess();
		$this->_mapperAccess = FactoryMapper::createMapperAccess();
	}

	/**
	 * @param $access
	 *
	 * @return AccessBuilder
	 * @throws AccessNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function getMinimumById ($access) {
		$this->_data = $this->_mapperAccess->fromEntityToDto($this->_dao->getAccessById($access));

		return $this;
	}

}