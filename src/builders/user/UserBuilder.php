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
}