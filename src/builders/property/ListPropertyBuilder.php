<?php
class ListPropertyBuilder extends ListBuilder {
	private $_mapperProperty;
	private $_loggedUser;

	/**
	 * ListPropertyBuilder constructor.
	 *
	 * @param int $loggedUser
	 */
	public function __construct (int $loggedUser) {
		$this->_mapperProperty = FactoryMapper::createMapperProperty();
		$this->_dao = FactoryDao::createDaoProperty();
		$this->_loggedUser = $loggedUser;
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
	 * @return ListPropertyBuilder
	 * @throws DatabaseConnectionException
	 */
	function getAll () {
		try {
			$this->_data = $this->_mapperProperty->fromEntityArrayToDtoArray($this->_dao->getAllProperty($this->_loggedUser));
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