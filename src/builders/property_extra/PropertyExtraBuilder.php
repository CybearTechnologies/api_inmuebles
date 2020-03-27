<?php
class PropertyExtraBuilder extends Builder {
	private $_mapperPropExtra;

	/**
	 * PropertyExtraBuilder constructor.
	 */
	public function __construct () {
		$this->_mapperPropExtra = FactoryMapper::createMapperPropertyExtra();
		$this->_dao = FactoryDao::createDaoPropertyExtra();
	}

	/**
	 * @param int $id
	 *
	 * @return PropertyExtraBuilder
	 * @throws DatabaseConnectionException
	 * @throws PropertyExtraNotFoundException
	 */
	public function getMinimumById (int $id) {
		$this->_data = $this->_mapperPropExtra->fromEntityToDto($this->_dao->getPropertyExtraById($id));

		return $this;
	}
}