<?php
class CommandGetRatingById extends Command {
	private $_mapperRating;

	/**
	 * CommandGetRatingById constructor.
	 *
	 * @param Rating $rating
	 */
	public function __construct ($rating) {
		$this->_dao = FactoryDao::createDaoRating($rating);
		$this->_mapperRating = FactoryMapper::createMapperRating();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws RatingNotFoundException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$dtoRating = $this->_mapperRating->fromEntityToDto($this->_dao->getRatingById());
		Tools::setUserToDto($dtoRating,$dtoRating->userCreator,$dtoRating->userModifier);
		$this->setData($dtoRating);
	}

	/**
	 * @return DtoRating
	 */
	public function return ():DtoRating {
		return $this->getData();
	}
}

