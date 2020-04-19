<?php
class ListUserBuilder extends ListBuilder {
	private $_mapper;

	public function __construct () {
		$this->_dao = FactoryDao::createDaoUser();
		$this->_mapper = FactoryMapper::createMapperUser();
	}

	/**
	 * @inheritDoc
	 */
	function getMinimumById (int $id) {
		return $this;
	}

	/**
	 * @return ListUserBuilder
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 */
	function getAll () {
		$this->_data = $this->_mapper->fromEntityArrayToDtoArray($this->_dao->getAllUser());

		return $this;
	}

	/**
	 * @return ListUserBuilder
	 * @throws DatabaseConnectionException
	 */
	public function withSeat () {
		$seatBuilder = new SeatBuilder();
		foreach ($this->_data as $datum) {
			try {
				$datum->seat = $seatBuilder
					->getMinimumById($datum->seat)
					->withAgency()
					->clean()
					->build();
			}
			catch (SeatNotFoundException $e) {
				unset($datum->seat);
			}
		}

		return $this;
	}

	/**
	 * @return $this
	 * @throws DatabaseConnectionException
	 */
	function withRol () {
		$rolBuilder = new RolBuilder();
		foreach ($this->_data as $datum) {
			try {
				$datum->rol = $rolBuilder
					->getMinimumById($datum->rol)
					->clean()
					->build();
			}
			catch (RolNotFoundException $e) {
				unset($datum->rol);
			}
		}

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	function withPlan () {
		$planBuilder = new PlanBuilder();
		foreach ($this->_data as $datum) {
			try {
				$datum->plan = $planBuilder
					->getMinimumById($datum->plan)
					->clean()
					->build();
			}
			catch (PlanNotFoundException $e) {
				unset($datum->plan);
			}
		}

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	function withLocation () {
		$locationBuilder = new LocationBuilder();
		foreach ($this->_data as $datum) {
			try {
				$datum->location = $locationBuilder
					->getMinimumById($datum->location)
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
	 * @return ListBuilder
	 */
	public function clean () {
		parent::clean();
		foreach ($this->_data as $datum) {
			unset($datum->password);
		}

		return $this;
	}
}