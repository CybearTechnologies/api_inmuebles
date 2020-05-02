<?php
class PlanBuilder extends Builder {
	private $_mapper;

	/**
	 * PlanBuilder constructor.
	 */
	public function  __construct () {
		$this->_dao = FactoryDao::createDaoPlan();
		$this->_mapper = FactoryMapper::createMapperPlan();
	}

	/**
	 * @param int $id
	 *
	 * @return PlanBuilder
	 * @throws DatabaseConnectionException
	 * @throws PlanNotFoundException
	 */
	public function getMinimumById (int $id) {
		$this->_data = $this->_mapper->fromEntityToDto($this->_dao->getPlanById($id));

		return $this;
	}
}