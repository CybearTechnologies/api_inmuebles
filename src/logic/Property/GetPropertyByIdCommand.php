<?php
class GetPropertyByIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetPropertyByIdCommand constructor.
	 *
	 * @param $id
	 */
	public function __construct ($id) {
		$this->_id = $id;
		$this->_dao = FactoryDao::createDaoProperty();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getPropertyById($this->_id));
	}

	/**
	 * @return Property
	 */
	public function return () {
		return $this->getData();
	}
}