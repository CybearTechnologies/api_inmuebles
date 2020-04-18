<?php
class CommandUpdateExtra extends Command {
	private $_id;
	private $_name;
	private $_icon;
	private $_user;

	/**
	 * CommandUpdateExtra constructor.
	 *
	 * @param $id
	 * @param $name
	 * @param $icon
	 * @param $user
	 */
	public function __construct ($id, $name, $icon, $user) {
		$this->_id = $id;
		$this->_name = $name;
		$this->_icon = $icon;
		$this->_user = $user;
		$this->_dao = FactoryDao::createDaoExtra();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->updateExtraById($this->_id, $this->_name, $this->_icon, $this->_user));
	}

	public function return () {
		return $this->getData();
	}
}