<?php
class PropertyTypeBuilder extends Builder {
	private $_mapper;

	/**
	 * PropertyTypeBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoPropertyType();
		$this->_mapper = FactoryMapper::createMapperPropertyType();
	}

	/**
	 * @param int $id
	 *
	 * @return PropertyTypeBuilder
	 * @throws DatabaseConnectionException
	 * @throws PropertyTypeNotFoundException
	 */
	public function getMinimumById (int $id) {
		$this->_data = $this->_mapper->fromEntityToDTO($this->_dao->getPropertyTypeById($id));

		return $this;
	}
}