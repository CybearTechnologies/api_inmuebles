<?php
class ListPropertyBuilder extends ListBuilder {
	private $_mapperProperty;

	/**
	 * ListPropertyBuilder constructor.
	 *
	 */
	public function __construct () {
		$this->_mapperProperty = FactoryMapper::createMapperProperty();
		$this->_dao = FactoryDao::createDaoProperty();
	}

	/**
	 * By user creator
	 *
	 * @param int $id
	 *
	 * @return ListPropertyBuilder
	 * @throws DatabaseConnectionException
	 */
	function getMinimumById (int $id) {
		try {
			$this->_data = $this->_mapperProperty->fromEntityArrayToDtoArray($this->_dao->getPropertiesByUser($id));
		}
		catch (PropertyNotFoundException $e) {
			$this->_data = [];
		}

		return $this;
	}

	/**
	 * @param int $loggedUser
	 *
	 * @return ListPropertyBuilder
	 * @throws DatabaseConnectionException
	 */
	function getAll (int $loggedUser = Values::DEFAULT_FOREIGN) {
		try {
			$this->_data = $this->_mapperProperty->fromEntityArrayToDtoArray($this->_dao->getAllProperty($loggedUser));
			foreach ($this->_data as $datum) {
				unset($datum->extras);
				unset($datum->request);
				unset($datum->price);
			}
		}
		catch (PropertyNotFoundException $e) {
			$this->_data = [];
		}

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	function withExtras () {
		$propertyExtraBuilder = new ListPropertyExtraBuilder();
		foreach ($this->_data as $datum) {
			try {
				$datum->extras = $propertyExtraBuilder->getMinimumById($datum->id)
					->clean()
					->build();
			}
			catch (PropertyExtraNotFoundException $e) {
				$datum->extras = [];
			}
		}

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	function withLastTwoPrices () {
		$listPriceBuilder = new ListPropertyPriceBuilder();
		foreach ($this->_data as $item) {
			try {
				$item->price = $listPriceBuilder->getLastTwoPropertyPriceByProperty($item->id)
					->clean()
					->build();
			}
			catch (InvalidPropertyPriceException $e) {
				$item->price = [];
			}
		}

		return $this;
	}

	/**
	 * @return ListPropertyBuilder
	 * @throws DatabaseConnectionException
	 */
	function withLocation () {
		$locationBuilder = new LocationBuilder();
		foreach ($this->_data as $datum) {
			try {
				$datum->location = $locationBuilder->getMinimumById($datum->id)
					->clean()
					->build();
			}
			catch (LocationNotFoundException $e) {
				unset($datum->location);
			}
		}

		return $this;
	}

	/**
	 * @return ListPropertyBuilder
	 * @throws DatabaseConnectionException
	 */
	function withType () {
		$typeBuilder = new PropertyTypeBuilder();
		foreach ($this->_data as $datum) {
			try {
				$datum->type = $typeBuilder
					->getMinimumById($datum->id)
					->clean()
					->build();
			}
			catch (PropertyTypeNotFoundException $e) {
				unset($datum->type);
			}
		}

		return $this;
	}
}