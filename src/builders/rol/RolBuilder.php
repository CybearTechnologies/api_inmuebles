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
		$this->_data->id = $id;
		unset($this->_data->access);

		return $this;
	}

	/**
	 * @return RolBuilder
	 * @throws DatabaseConnectionException
	 */
	public function withAccess () {
		$listAccessBuilder = new ListAccessBuilder();
		try {
			$this->_data->access = $listAccessBuilder->getMinimumById($this->_data->id)->clean()->build();
		}
		catch (AccessNotFoundException $e) {
			$this->_data->access = [];
		}

		return $this;
	}

	/**
	 * @param $name
	 * @param $access
	 *
	 * @return RolBuilder
	 * @throws DatabaseConnectionException
	 */
	public function insertRol ($name, $access) {
		$this->_data = $this->_mapperRol->fromEntityToDto($this->_dao->createRol($name));
		if (!empty($access)) {
			$this->_dao = FactoryDao::createDaoRolAccess();
			foreach ($access as $itm) {
				$this->_dao->createRolAccess($this->_data->id, $itm);
			}
		}

		return $this;
	}
}