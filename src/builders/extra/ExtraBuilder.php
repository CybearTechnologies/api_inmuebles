<?php
class ExtraBuilder extends Builder {
	private $_mapperExtra;
	private $_daoExtra;

	/**
	 * ExtraBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoExtra();
		$this->_mapperExtra = FactoryMapper::createMapperExtra();
	}

	/**
	 * @param int $id
	 *
	 * @return ExtraBuilder
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function getMinimumById (int $id) {
		$this->_data = $this->_mapperExtra->fromEntityToDto($this->_dao->getExtraById($id));

		return $this;
	}
}