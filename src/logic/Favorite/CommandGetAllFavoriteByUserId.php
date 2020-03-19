<?php
class CommandGetAllFavoriteByUserId extends Command {
	private $_id;
	private $_mapperFavorite;
	/**
	 * CommandGetAllFavoriteByUserId constructor.
	 */
	public function __construct ($id) {
		$this->_dao = FactoryDao::createDaoFavorite();
		$this->_mapperFavorite = FactoryMapper::createMapperFavorite();
		$this->_id = $id;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws FavoriteNotFoundException
	 * @throws MultipleUserException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$dtoFavorite = $this->_mapperFavorite->fromEntityArrayToDtoArray($this->_dao->getAllFavoriteByUserId($this->_id));
		Tools::setUserToDto($dtoFavorite,$dtoFavorite->userCreator,$dtoFavorite->userModifier);
		$this->setPropertyToDto($dtoFavorite);
		$this->setData($dtoFavorite);
	}

	/**
	 * @param $dtoFavorite
	 *
	 * @throws DatabaseConnectionException
	 */
	private function setPropertyToDto($dtoFavorite){
		$command = FactoryCommand::createCommandGetPropertyById(FactoryEntity::createProperty($dtoFavorite->property));
		try {
			$command->execute();
			$dtoFavorite->property = $command->return();
		}
		catch (PropertyNotFoundException $e) { //TODO revisar con calma
			unset($dtoFavorite->property);
		}
	}

	/**
	 * @return Favorite
	 */
	public function return () {
		return $this->getData();
	}
}