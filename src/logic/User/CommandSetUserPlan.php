<?php
class CommandSetUserPlan extends Command {
	private $_user;
	private $_plan;
	/**
	 * CommandSetUserPlan constructor.
	 *
	 * @param $user
	 */
	public function __construct ($user,$plan) {
		$this->_dao = FactoryDao::createDaoUser();
		$this->_user = $user;
		$this->_plan = $plan;;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->setUserPlan($this->_user,$this->_plan));
	}

	/**
	 * @return User
	 */
	public function return () {
		return $this->getData();
	}
}