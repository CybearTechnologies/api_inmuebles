<?php
class GetAllExtrasByPropertyIdCommand extends Command {
	private $_dao;
	private $_id;

	/**
	 * GetAllExtrasByPropertyIdCommand constructor.
	 *
	 * @param $id
	 */
	public function __construct ($id) {
		$this->_id = $id;
		$this->_dao = FactoryDao::createDaoExtra();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllPropertyExtra($this->_id));
	}

	/**
	 * @return Extra[]
	 */
	public function return () {
		return $this->getData();
	}
}