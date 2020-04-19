<?php
class CommandCreateRequest extends Command {
	private $_property;
	private $_user;

	/**
	 * CommandCreateRequest constructor.
	 *
	 * @param int $property
	 * @param int $user
	 */
	public function __construct (int $property, int $user) {
		$this->_dao = FactoryDao::createDaoRequest();
		$this->_property = $property;
		$this->_user = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->createRequest($this->_property, $this->_user));
	}

	/**
	 * @return Request
	 */
	public function return () {
		return $this->getData();
	}
}