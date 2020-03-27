<?php
class ListExtraBuilder extends ListBuilder {
	private $_mapperExtra;

	/**
	 * ListExtraBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoExtra();
		$this->_mapperExtra = FactoryMapper::createMapperExtra();
	}

	/**
	 * @param int $id
	 *
	 * @return ListExtraBuilder
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	function getMinimumById (int $id) {
		$this->_data = $this->_mapperExtra->fromEntityArrayToDtoArray($this->_dao->getAllExtrasByPropertyId($id));

		return $this;
	}

	/**
	 * @return ListExtraBuilder
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	function getAll () {
		$this->_data = $this->_mapperExtra->fromEntityArrayToDtoArray($this->_dao->getAllExtra());

		return $this;
	}
}