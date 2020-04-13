<?php
class ListSubscriptionBuilder extends ListBuilder {
	private $_mapper;

	/**
	 * ListSubscriptionBuilder constructor.
	 */
	public function __construct () {
		$this->_dao = FactoryDao::createDaoSubscription();
		$this->_mapper = FactoryMapper::createMapperSubscription();

		return $this;
	}

	/**
	 * @param int $id
	 *
	 * @return ListSubscriptionBuilder
	 */
	function getMinimumById (int $id) {
		return $this;
	}

	/**
	 * @return ListSubscriptionBuilder
	 * @throws DatabaseConnectionException
	 * @throws SubscriptionNotFoundException
	 */
	function getAll () {
		$this->_data = $this->_mapper->fromEntityArrayToDtoArray($this->_dao->getAllSubscription());
		foreach ($this->_data as $datum) {
			unset($datum->detail);
		}
		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	function withSeat () {
		$seatBuilder = new SeatBuilder();
		foreach ($this->_data as $datum) {
			try {
				$datum->seat = $seatBuilder->getMinimumById($datum->seat)->withAgency()->clean()->build();
			}
			catch (SeatNotFoundException $e) {
				unset($datum->seat);
			}
		}

		return $this;
	}

	/**
	 * @return ListSubscriptionBuilder
	 * @throws DatabaseConnectionException
	 */
	public function andLocation () {
		$locationBuilder = new LocationBuilder();
		foreach ($this->_data as $datum) {
			try {
				$datum->location = $locationBuilder->getMinimumById($datum->location)->clean()->build();
			}
			catch (LocationNotFoundException $e) {
				unset($datum->location);
			}
		}

		return $this;
	}

	/**
	 * @return $this
	 * @throws DatabaseConnectionException
	 */
	public function andPlan () {
		$planBuilder = new PlanBuilder();
		foreach ($this->_data as $datum) {
			try {
				$datum->plan = $planBuilder->getMinimumById($datum->plan)->clean()->build();
			}
			catch (PlanNotFoundException $e) {
				unset($datum->plan);
			}
		}

		return $this;
	}
}