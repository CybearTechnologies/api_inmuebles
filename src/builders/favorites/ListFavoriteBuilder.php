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
	 */
	function getMinimumById (int $id) {
		try {
			$this->_data = $this->_mapper->fromEntityArrayToDtoArray($this->_dao->getAllFavoriteByUserId($id));
		}
		catch (FavoriteNotFoundException $e) {
			$this->_data = [];
		}

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	function withProperties () {
		$propertyBuilder = new PropertyBuilder();
		foreach ($this->_data as $datum) {
			try {
				$datum->property = $propertyBuilder
					->getMinimumById($datum->property)
					->withLastTwoPrices()
					->setFavorite()
					->withType()
					->withLocation()
					->withExtras()
					->clean()
					->build();
			}
			catch (PropertyNotFoundException $e) {
				$this->_data = [];
			}
		}

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	function getAll () {
		return $this;
	}
}