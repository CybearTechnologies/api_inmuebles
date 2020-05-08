<?php
class CommandUpdateUserRol extends Command {
	private $_mapper;
	private $_id;
	private $_rol;
	private $_userModifier;
	private $_dateModified;

	/**
	 * CommandUpdateUserRol constructor.
	 *
	 * @param int    $id
	 * @param int    $rol
	 * @param int    $userModifier
	 * @param  $dateModified
	 */
	public function __construct (int $id, int $rol, int $userModifier, $dateModified) {
		$this->_id = $id;
		$this->_rol = $rol;
		$this->_userModifier = $userModifier;
		$this->_dateModified = $dateModified;
		$this->_dao = FactoryDao::createDaoUser();
		$this->_mapper = FactoryMapper::createMapperUser();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$dtoUser = $this->_mapper->fromEntityToDto($this->_dao->changeRol($this->_id, $this->_rol, $this->_userModifier,
			$this->_dateModified));
		$this->clean($dtoUser);

		$this->setData($dtoUser);
	}

	/**
	 * @param $dtoUser
	 */
	private function clean($dtoUser){
		unset($dtoUser->password);
		unset($dtoUser->identity);
		unset($dtoUser->passport);
		unset($dtoUser->documents);
		unset($dtoUser->dateCreated);
		unset($dtoUser->dateModified);
	}
	/**
	 * @return DtoUser
	 */
	public function return () {
		return $this->getData();
	}
}