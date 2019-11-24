<?php
class GetExtraByIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetExtraByIdCommand constructor.
	 *
	 * @param int $id
	 */
	public function __construct (int $id) {
		$this->_dao = FactoryDao::createDaoExtra();
		$this->_id = $id;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getExtraById($this->_id));
	}

	/**
	 * @return mixed
	 */
	public function return () {
		return $this->getData();
	}
}