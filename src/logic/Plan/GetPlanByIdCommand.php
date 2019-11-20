<?php
class GetPlanByIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetPlanByIdCommand constructor.
	 *
	 * @param $_id
	 */
	public function __construct ($_id) { $this->_id = $_id; }

	public function execute ():void {
		$this->_dao = FactoryDao::createDaoPlan();
		$this->setData($this->_dao->getPlanById($this->_id));
	}

	public function return () {
		return $this->getData();
	}
}