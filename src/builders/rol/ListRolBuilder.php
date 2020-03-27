<?php
class ListRolBuilder extends ListBuilder {
	private $_mapperRol;

	/**
	 * ListRolBuilder constructor.
	 */
	public function __construct () {
		$this->_mapperRol = FactoryMapper::createMapperRol();
		$this->_dao = FactoryDao::createDaoRol();
	}

	/**
	 * @param int $id
	 *
	 * @return ListRolBuilder
	 */
	function getMinimumById (int $id) {
		return $this;
	}

	/**
	 * @return ListRolBuilder
	 * @throws DatabaseConnectionException
	 * @throws RolNotFoundException
	 */
	function getAll () {
		$this->_data = $this->_mapperRol->fromEntityArrayToDtoArray($this->_dao->getAllRol());

		return $this;
	}
}