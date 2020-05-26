<?php
class CommandDeleteFavorite extends Command {
	private $_id;
	private $_user;

	/**
	 * CommandDeleteFavorite constructor.
	 *
	 * @param $id
	 * @param $user
	 */
	public function __construct ($id, $user) {
		$this->_dao = FactoryDao::createDaoFavorite();
		$this->_id = $id;
		$this->_user = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws FavoriteNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->deleteFavorite($this->_id, $this->_user));
	}

	/**
	 * @return Favorite
	 */
	public function return () {
		return $this->getData();
	}
}