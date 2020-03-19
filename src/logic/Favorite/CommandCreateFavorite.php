<?php
class CommandCreateFavorite extends Command {
	/**
	 * CommandCreateFavorite constructor.
	 *
	 * @param Favorite $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoFavorite($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->createFavorite());
	}

	/**
	 * @return Favorite
	 */
	public function return () {
		return $this->getData();
	}
}