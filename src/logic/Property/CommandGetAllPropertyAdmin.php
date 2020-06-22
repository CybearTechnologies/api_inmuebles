<?php
class CommandGetAllPropertyAdmin extends Command {
	private $_loggedUser;
	private $_builder;

	/**
	 * CommandGetAllPropertyAdmin constructor.
	 *
	 * @param $user
	 */
	public function __construct ($user) {
		$this->_dao = FactoryDao::createDaoProperty();
		$this->_builder = new ListPropertyBuilder();
		$this->_loggedUser = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_builder->getAllAdmin($this->_loggedUser)
			->withLocation()
			->withType()
			->withLastTwoPrices()
			->withExtras()
			->clean()
			->build());
	}

	/**
	 * @return mixed
	 */
	public function return () {
		return $this->getData();
	}
}