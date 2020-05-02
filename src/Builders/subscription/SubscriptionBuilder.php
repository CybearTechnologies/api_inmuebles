<?php
class SubscriptionBuilder extends Builder {
	private $_mapper;

	/**
	 * SubscriptionBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoSubscription();
		$this->_mapper = FactoryMapper::createMapperSubscription();
	}

	/**
	 * @param int $id
	 *
	 * @return SubscriptionBuilder
	 * @throws DatabaseConnectionException
	 * @throws SubscriptionNotFoundException
	 */
	public function getMinimumById (int $id) {
		$this->_data = $this->_mapper->fromEntityToDto($this->_dao->getSubscriptionById($id));

		return $this;
	}

	/**
	 * @param string $email
	 *
	 * @return $this
	 * @throws DatabaseConnectionException
	 * @throws SubscriptionNotFoundException
	 */
	public function getMinimumByEmail(string $email){
		$this->_data = $this->_mapper->fromEntityToDto($this->_dao->getSubscriptionByEmail($email));

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function withDetails () {
		$detailBuilder = new ListSubscriptionDetailBuilder();
		try {
			$this->_data->detail = $detailBuilder->getMinimumById($this->_data->id)->clean()->build();
		}
		catch (SubscriptionDetailNotFoundException $e) {
			$this->_data->detail = [];
		}

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function andPlan () {
		$planBuilder = new PlanBuilder();
		try {
			$this->_data->plan = $planBuilder->getMinimumById($this->_data->plan)->clean()->build();
		}
		catch (PlanNotFoundException $e) {
			unset($this->_data->plan);
		}

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function andLocation () {
		$locationBuilder = new LocationBuilder();
		try {
			$this->_data->location = $locationBuilder->getMinimumById($this->_data->location)->clean()->build();
		}
		catch (LocationNotFoundException $e) {
			unset($this->_data->location);
		}

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function andSeat () {
		$seatBuilder = new SeatBuilder();
		try {
			$this->_data->seat = $seatBuilder->getMinimumById($this->_data->seat)->withAgency()->clean()->build();
		}
		catch (SeatNotFoundException $e) {
			unset($this->_data->seat);
		}

		return $this;
	}
}