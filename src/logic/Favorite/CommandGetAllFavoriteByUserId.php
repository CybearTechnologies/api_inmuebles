<?php
class CommandGetAllFavoriteByUserId extends Command {
	private $_builder;
	private $_id;

	/**
	 * CommandGetAllFavoriteByUserId constructor.
	 *
	 * @param $id
	 */
	public function __construct ($id) {
		$this->_id = $id;
		$this->_builder = new ListFavoriteBuilder();
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$dtoFavorites = $this->_builder->getMinimumById($this->_id)->clean()->build();
		$this->setData($dtoFavorites);
	}

	/**
	 * @return DtoFavorite
	 */
	public function return () {
		return $this->getData();
	}
}