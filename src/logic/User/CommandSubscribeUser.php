<?php
class CommandSubscribeUser extends Command {
	private $_command;
	private $_subDetail;
	private $_mapperSubscription;
	/**
	 * CommandSubscribeUser constructor.
	 *
	 * @param $subscription
	 * @param $subDetail
	 */
	public function __construct ($subscription,$subDetail) {
		$this->_dao = FactoryDao::createDaoSubscription($subscription);
		$this->_subDetail = $subDetail;
		$this->_mapperSubscription = FactoryMapper::

	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$subscription= $this->_dao->createSubscription();
		$dtoSubscription=
		$this->_command= FactoryCommand::createCommandAddSubscribeDetail($this->_subDetail);
		$this->_command->execute();
	}

	public function return () {

	}
}