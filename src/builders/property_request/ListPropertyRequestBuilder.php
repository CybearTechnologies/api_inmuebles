<?php
class ListPropertyRequestBuilder extends ListBuilder {
	private $_mapperRequest;

	/**
	 * ListPropertyRequestBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoRequest();
		$this->_mapperRequest = FactoryMapper::createMapperRequest();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function getAll () {
		$this->_data = $this->_mapperRequest->fromEntityArrayToDtoArray($this->_dao->getAllRequest());

		return $this;
	}

	/**
	 * @param int $id
	 *
	 * @return ListPropertyRequestBuilder
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function getMinimumById (int $id) {
		$this->_data = $this->_mapperRequest->fromEntityArrayToDtoArray($this->_dao->getAllRequestByPropertyId($id));
		foreach ($this->_data as $item) {
			unset($item->property);
		}

		return $this;
	}

	/**
	 * @param int $id
	 *
	 * @return ListPropertyRequestBuilder
	 * @throws DatabaseConnectionException
	 */
	public function getPendingRequest (int $id) {
		try {
			$this->_data = $this->_mapperRequest->fromEntityArrayToDtoArray($this->_dao->getPendingRequest($id));
		}
		catch (RequestNotFoundException $e) {
			$this->_data = [];
		}

		return $this;
	}

	/**
	 * @param int $id
	 *
	 * @return ListPropertyRequestBuilder
	 * @throws DatabaseConnectionException
	 */
	public function getUserRequest (int $id) {
		try {
			$this->_data = $this->_mapperRequest->fromEntityArrayToDtoArray($this->_dao->getAllRequestByUserId($id));
		}
		catch (RequestNotFoundException $e) {
			$this->_data = [];
		}

		return $this;
	}

	/**
	 * @return ListPropertyRequestBuilder
	 * @throws DatabaseConnectionException
	 */
	public function withProperty () {
		$builder = new PropertyBuilder();
		try {
			foreach ($this->_data as $datum) {
				$datum->property = $builder->getMinimumById($datum->property)
					->withLocation()
					->withExtras()
					->withType()
					->withLastTwoPrices()
					->withUserDetail()
					->build();
			}
		}
		catch (PropertyNotFoundException $e) {
			unset($datum);
		}

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function withUser () {
		$builder = new UserBuilder();
		try {
			foreach ($this->_data as $datum) {
				$datum->userCreator = $builder->getMinimumById($datum->userCreator)
					->withRol()
					->withPlan()
					->withSeat()
					->withLocation()
					->clean()
					->build();
				unset($datum->userModifier);
			}
		}
		catch (UserNotFoundException|MultipleUserException $e) {
			unset($datum);
		}

		return $this;
	}
}