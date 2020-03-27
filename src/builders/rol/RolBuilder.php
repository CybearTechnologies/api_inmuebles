<?php
class RolBuilder extends Builder {
	private $_mapperRol;
	private $_id;

	/**
	 * RolBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoRol();
		$this->_mapperRol = FactoryMapper::createMapperRol();
	}

	/**
	 * @param int $id
	 *
	 * @return RolBuilder
	 * @throws DatabaseConnectionException
	 * @throws RolNotFoundException
	 */
	public function getMinimumById (int $id) {
		$this->_data = $this->_mapperRol->fromEntityToDto($this->_dao->getRolById($id));
		$this->_id = $id;

		return $this;
	}

	/**
	 * @return RolBuilder
	 */
	public function withAccess () {
		$listAccessBuilder = new ListAccessBuilder();
		$this->_data->access = $listAccessBuilder->getMinimumById($this->_id);

		return $this;
	}
}