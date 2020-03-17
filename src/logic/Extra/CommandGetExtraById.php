<?php
class CommandGetExtraById extends Command {
	private $_mapperExtra;
	private $_mapperUser;

	/**
	 * CommandGetExtraById constructor.
	 *
	 * @param Extra $extra
	 */
	public function __construct ($extra) {
		$this->_dao = FactoryDao::createDaoExtra($extra);
		$this->_mapperExtra = FactoryMapper::createMapperExtra();
		$this->_mapperUser = FactoryMapper::createMapperUser();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 * @throws MultipleUserException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$extra = $this->_dao->getExtraById();
		$dtoExtra = $this->_mapperExtra->fromEntityToDto($extra);
		Tools::setUserToDto($dtoExtra,$extra->getUserCreator(),$extra->getUserModifier());
		$this->setData($dtoExtra);
	}

	/**
	 * @return DtoExtra
	 */
	public function return () {
		return $this->getData();
	}
}