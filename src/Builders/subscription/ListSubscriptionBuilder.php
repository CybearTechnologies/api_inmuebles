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
	 * @return ListSubscriptionBuilder
	 * @throws AgencyNotFoundException
	 * @throws DatabaseConnectionException
	 */
	function withSeat () {
		$seatBuilder = new SeatBuilder();
		$agencyBuilder = new AgencyBuilder();
		foreach ($this->_data as $datum) {
			try {
				if (($datum->seat !== null) && is_numeric($datum->seat)) {

					$datum->seat = $seatBuilder->getMinimumById($datum->seat)->clean()->build();
					$datum->agency = $agencyBuilder->getMinimumById($datum->agency)
						->clean()
						->build();
				}
				else if (($datum->agency!==null) && is_numeric($datum->agency))
					$datum->agency = $agencyBuilder->getMinimumById($datum->agency)
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

	/**
	 * @throws DatabaseConnectionException
	 */
	public function andDetails () {
		$detailBuilder = new ListSubscriptionDetailBuilder();
		foreach ($this->_data as $datum) {
			try {
				$datum->detail = $detailBuilder->getMinimumById($datum->id)->clean()->build();
			}
			catch (SubscriptionDetailNotFoundException $e) {
				$datum->detail = [];
			}
		}

		return $this;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function andIdentity () {
		$subscriptionBuilder = new SubscriptionBuilder();
		foreach ($this->_data as $datum) {
			try {
				$subscription = $subscriptionBuilder->getMinimumByEmail($datum->email)->clean()->build();
				$datum->identity = $subscription->ci;
				$datum->passport = $subscription->passport;
			}
			catch (SubscriptionNotFoundException $e) {
				$datum->identity = "";
				$datum->passport = "";
			}
		}

		return $this;
	}
}