<?php
class ListPropertyExtraBuilder extends ListBuilder {
	private $_mapper;

	/**
	 * ListPropertyExtraBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoPropertyExtra();
		$this->_mapper = FactoryMapper::createMapperPropertyExtra();
	}

	/**
	 * @param int $id
	 *
	 * @return ListPropertyExtraBuilder
	 * @throws DatabaseConnectionException
	 * @throws PropertyExtraNotFoundException
	 */
	function getMinimumById (int $id) {
		$this->_data = $this->_mapper->fromEntityArrayToDtoArray($this->_dao->getPropertyExtraByPropertyId($id));
		foreach ($this->_data as $datum) {
			unset($datum->property);
		}
		return $this;
	}

	/**
	 * @return ListPropertyExtraBuilder
	 */
	function getAll () {
		return $this;
	}
}