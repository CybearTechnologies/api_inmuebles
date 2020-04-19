<?php
class UserBuilder extends Builder {
	private $_mapper;

	/**
	 * UserBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoUser();
		$this->_mapper = FactoryMapper::createMapperUser();
	}

	/**
	 * @param int $id
	 *
	 * @return UserBuilder
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws UserNotFoundException
	 */
	public function getMinimumById (int $id) {
		$this->_data = $this->_mapper->fromEntityToDto($this->_dao->getUserById($id));
		unset($this->_data->password);

		return $this;
	}

	/**
	 * @param string $username
	 *
	 * @return $this
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws UserNotFoundException
	 */
	public function getMinimumByUsername (string $username) {
		$this->_data = $this->_mapper->fromEntityToDto($this->_dao->getUserByUsername($username));

		return $this;
	}

	/**
	 * @return UserBuilder
	 * @throws DatabaseConnectionException
	 */
	public function withSeat () {
		$seatBuilder = new SeatBuilder();
		try {
			$this->_data->seat = $seatBuilder->getMinimumById($this->_data->seat)
				->withAgency()
				->clean()
				->build();
		}
		catch (SeatNotFoundException $e) {
			unset($this->_data->seat);
		}

		return $this;
	}

	/**
	 * @return $this
	 * @throws DatabaseConnectionException
	 */
	function withRol () {
		$rolBuilder = new RolBuilder();
		try {
			$this->_data->rol = $rolBuilder->getMinimumById($this->_data->rol)->clean()->build();
		}
		catch (RolNotFoundException $e) {
			unset($this->_data->rol);
		}

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	function withPlan () {
		$planBuilder = new PlanBuilder();
		try {
			$this->_data->plan = $planBuilder
				->getMinimumById($this->_data->plan)
				->clean()
				->build();
		}
		catch (PlanNotFoundException $e) {
			unset($this->_data->plan);
		}

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	function withLocation () {
		$locationBuilder = new LocationBuilder();
		try {
			$this->_data->location = $locationBuilder
				->getMinimumById($this->_data->location)
				->clean()
				->build();
		}
		catch (LocationNotFoundException $e) {
			unset($this->_data->location);
		}

		return $this;
	}
}