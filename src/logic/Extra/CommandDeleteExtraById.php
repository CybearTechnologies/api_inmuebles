<?php
class CommandDeleteExtraById extends Command {
	private $_id;
	private $_user;

	/**
	 * CommandDeleteExtraById constructor.
	 *
	 * @param int $id
	 * @param int $user
	 */
	public function __construct (int $id, int $user) {
		$this->_dao = FactoryDao::createDaoExtra();
		$this->_id = $id;
		$this->_user = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->deleteExtraById($this->_id, $this->_user));
	}

	/**
	 * @return Extra
	 */
	public function return () {
		return $this->getData();
	}
}