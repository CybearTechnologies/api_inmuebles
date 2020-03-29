<?php
class ExtraBuilder extends Builder {
	private $_mapperExtra;
	private $_daoExtra;

	/**
	 * ExtraBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoExtra();
		$this->_mapperExtra = FactoryMapper::createMapperExtra();
	}

	/**
	 * @param int $id
	 *
	 * @return ExtraBuilder
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function getMinimumById (int $id) {
		$this->_data = $this->_mapperExtra->fromEntityToDto($this->_dao->getExtraById($id));

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function withUserCreator () {
		$userBuilder = new UserBuilder();
		try {

			$this->_data->userCreator = $userBuilder
												->getMinimumById($this->_data->userCreator)
												->clean()
												->build();

			unset($this->_data->userCreator->seat);
			unset($this->_data->userCreator->rol);
			unset($this->_data->userCreator->plan);
			unset($this->_data->userCreator->location);

		}
		catch (UserNotFoundException $e) {
			unset($this->_data->userCreator);
		}
		catch (MultipleUserException $e) {
			unset($this->_data->userCreator);
		}

		return $this;
	}
}