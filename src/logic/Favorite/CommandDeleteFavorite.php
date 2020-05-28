<?php
class CommandDeleteFavorite extends Command {
	private $_id;
	private $_user;
	private $_mapper;

	/**
	 * CommandDeleteFavorite constructor.
	 *
	 * @param $id
	 * @param $user
	 */
	public function __construct ($id, $user) {
		$this->_dao = FactoryDao::createDaoFavorite();
		$this->_mapper = FactoryMapper::createMapperFavorite();
		$this->_id = $id;
		$this->_user = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws FavoriteNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_mapper->fromEntityToDto($this->_dao->deleteFavorite($this->_id, $this->_user)));
	}

	/**
	 * @return DtoFavorite
	 */
	public function return () {
		return $this->getData();
	}
}