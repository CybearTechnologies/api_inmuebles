<?php
class CommandCreateFavorite extends Command {
	private $_property;
	private $_user;

	/**
	 * CommandCreateFavorite constructor.
	 *
	 * @param int $property
	 * @param int $user
	 */
	public function __construct ($property, $user) {
		$this->_dao = FactoryDao::createDaoFavorite();
		$this->_property = $property;
		$this->_user = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->createFavorite($this->_property, $this->_user));
	}

	/**
	 * @return Favorite
	 */
	public function return () {
		return $this->getData();
	}
}