<?php
class PropertyBuilder extends Builder {
	private $_mapperProperty;
	private $_id;

	/**
	 * PropertyBuilder constructor.
	 */
	public function __construct () {
		$this->_mapperProperty = FactoryMapper::createMapperProperty();
		$this->_dao = FactoryDao::createDaoProperty();
	}

	/**
	 * @param int $id
	 *
	 * @return PropertyBuilder
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function getMinimumById (int $id) {
		$this->_data = $this->_mapperProperty->fromEntityToDto($this->_dao->getPropertyById($id));
		$this->_id = $id;
		unset($this->_data->extras);
		unset($this->_data->request);
		unset($this->_data->price);

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function withExtras () {
		$propertyExtraBuilder = new ListPropertyExtraBuilder();
		try {
			$this->_data->extras = $propertyExtraBuilder
				->getMinimumById($this->_id)
				->clean()
				->build();
		}
		catch (PropertyExtraNotFoundException $e) {
			$this->_data->extras = [];
		}

		return $this;
	}

	/**
	 * @return PropertyBuilder
	 * @throws DatabaseConnectionException
	 */
	public function withRequest () {
		$listPropertyReqBuild = new ListPropertyRequestBuilder();
		try {
			$this->_data->request = $listPropertyReqBuild
				->getMinimumById($this->_id)
				->clean()
				->build();
		}
		catch (RequestNotFoundException $e) {
			$this->_data->request = [];
		}

		return $this;
	}

	/**
	 * @return $this
	 * @throws DatabaseConnectionException
	 */
	public function withPrice () {
		$propertyPriceBuilder = new ListPropertyPriceBuilder();
		try {
			$this->_data->price = $propertyPriceBuilder
				->getByPropertyId($this->_id)
				->clean()
				->build();
		}
		catch (InvalidPropertyPriceException $e) {
			$this->_data->price = [];
		}

		return $this;
	}

	/**
	 * @return $this
	 * @throws DatabaseConnectionException
	 */
	public function withUserDetail () {
		$userBuilder = new UserBuilder();
		try {
			$this->_data->userCreator = $userBuilder->getMinimumById($this->_data->userCreator)
				->withSeat()
				->clean()
				->build();
		}
		catch (MultipleUserException $e) {
			unset($this->_data->userCreator);
		}
		catch (UserNotFoundException $e) {
			unset($this->_data->userCreator);
		}

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function withLocation () {
		$locationBuilder = new LocationBuilder();
		try {
			$this->_data->location = $locationBuilder->getMinimumById($this->_data->location)->clean()->build();
		}
		catch (LocationNotFoundException $e) {
			unset ($this->_data->location);
		}

		return $this;
	}

	/**
	 * @return PropertyBuilder
	 * @throws DatabaseConnectionException
	 */
	public function withAllPrices () {
		$propertyPriceBuilder = new ListPropertyPriceBuilder();
		try {
			$this->_data->price = $propertyPriceBuilder
				->getByPropertyId($this->_id)
				->clean()
				->build();
		}
		catch (InvalidPropertyPriceException $e) {
			$this->_data->price = [];
		}

		return $this;
	}

	/**
	 * @return $this
	 * @throws DatabaseConnectionException
	 */
	public function withLastTwoPrices () {
		$propertyPriceBuilder = new ListPropertyPriceBuilder();
		try {
			$this->_data->price = $propertyPriceBuilder->getLastTwoPropertyPriceByProperty($this->_id)
				->clean()
				->build();
		}
		catch (InvalidPropertyPriceException $e) {
			$this->_data->price = [];
		}

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	function withType () {
		$propertyTypeBuilder = new PropertyTypeBuilder();
		try {
			$this->_data->type = $propertyTypeBuilder->getMinimumById($this->_data->type)->clean()->build();
		}
		catch (PropertyTypeNotFoundException $e) {
			unset($this->_data->type);
		}

		return $this;
	}
}