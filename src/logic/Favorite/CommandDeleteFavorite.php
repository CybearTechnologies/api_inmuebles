<?php
class CommandDeleteFavorite extends Command {
	private $_id;

	/**
	 * CommandDeleteFavorite constructor.
	 *
	 * @param $id
	 */
	public function __construct ($id) {
		$this->_dao = FactoryDao::createDaoFavorite();
		$this->_id = $id;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws FavoriteNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->deleteFavorite($this->_id));
	}

	/**
	 * @return Favorite
	 */
	public function return () {
		return $this->getData();
	}
}