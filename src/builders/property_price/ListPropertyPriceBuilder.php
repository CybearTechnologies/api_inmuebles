<?php
class ListPropertyPriceBuilder extends ListBuilder {
	private $_mapperPropPrice;

	/**
	 * ListPropertyPriceBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoPropertyPrice();
		$this->_mapperPropPrice = FactoryMapper::createMapperPropertyPrice();
	}

	/**
	 * @param int $id
	 *
	 * @return ListPropertyPriceBuilder
	 * @throws DatabaseConnectionException
	 * @throws InvalidPropertyPriceException
	 */
	public function getMinimumById (int $id) {
		$this->_data = $this->_mapperPropPrice->fromEntityArrayToDtoArray($this->_dao->getPropertyPriceById($id));

		return $this;
	}

	/**
	 * @param int $id
	 *
	 * @return $this
	 * @throws DatabaseConnectionException
	 * @throws InvalidPropertyPriceException
	 */
	public function getByPropertyId (int $id) {
		$this->_data = $this->_mapperPropPrice->fromEntityArrayToDtoArray($this->_dao->getPropertyPriceByPropertyId($id));
		foreach ($this->_data as $item) {
			unset($item->propertyId);
		}

		return $this;
	}

	/**
	 * @param int $id
	 *
	 * @return ListPropertyPriceBuilder
	 * @throws DatabaseConnectionException
	 * @throws InvalidPropertyPriceException
	 */
	public function getLastTwoPropertyPriceByProperty (int $id) {
		$this->_data = $this->_mapperPropPrice->fromEntityArrayToDtoArray($this->_dao->getLastTwoPropertyPriceByProperty($id));

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	function getAll () {
		return $this;
	}
}