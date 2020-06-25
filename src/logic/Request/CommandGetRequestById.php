<?php
class CommandGetRequestById extends Command {
	private $_id;

	/**
	 * CommandGetRequestById constructor.
	 *
	 * @param int $id
	 */
	public function __construct ($id) {
		$this->_dao = FactoryDao::createDaoRequest();
		$this->_id = $id;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getRequestById($this->_id));
	}

	/**
	 * @return Request
	 */
	public function return () {
		return $this->getData();
	}
}