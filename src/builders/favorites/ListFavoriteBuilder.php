<?php
class ListFavoriteBuilder extends ListBuilder {
	private $_mapper;

	/**
	 * ListFavoriteBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoFavorite();
		$this->_mapper = FactoryMapper::createMapperFavorite();
	}

	/**
	 * Favorite by user id
	 *
	 * @param int $id
	 *
	 * @return ListFavoriteBuilder
	 * @throws DatabaseConnectionException
	 * @throws FavoriteNotFoundException
	 */
	function getMinimumById (int $id) {
		$this->_data = $this->_mapper->fromEntityArrayToDtoArray($this->_dao->getAllFavoriteByUserId($id));
		
		return $this;
	}

	/**
	 * @inheritDoc
	 */
	function getAll () {
		return $this;
	}
}