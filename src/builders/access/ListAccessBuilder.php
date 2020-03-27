<?php
class ListAccessBuilder extends ListBuilder {
	private $_mapper;

	/**
	 * ListAccessBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoAccess();
		$this->_mapper = FactoryMapper::createMapperAccess();
	}

	/**
	 * @param int $id
	 *
	 * @return ListAccessBuilder
	 */
	function getMinimumById (int $id) {
		return $this;
	}

	/**
	 * @return ListAccessBuilder
	 * @throws AccessNotFoundException
	 * @throws DatabaseConnectionException
	 */
	function getAll () {
		$this->_data = $this->_mapper->fromEntityArrayToDtoArray($this->_dao->getAllAccess());

		return $this;
	}
}