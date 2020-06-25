<?php
class CommandUpdateUserProfile extends Command {
	private $_id;
	private $_firstName;
	private $_lastName;
	private $_address;
	private $_email;
	private $_mapper;
	private $_modifier;
	private $_phone;

	/**
	 * CommandUpdateUserProfile constructor.
	 *
	 * @param $_id
	 * @param $_firstName
	 * @param $_lastName
	 * @param $_address
	 * @param $_email
	 * @param $phone
	 * @param $modifier
	 */
	public function __construct ($_id, $_firstName, $_lastName, $_address, $_email, $phone,$modifier) {
		$this->_id = $_id;
		$this->_firstName = $_firstName;
		$this->_lastName = $_lastName;
		$this->_address = $_address;
		$this->_email = $_email;
		$this->_modifier = $modifier;
		$this->_phone = $phone;
		$this->_mapper = FactoryMapper::createMapperUser();
		$this->_dao = FactoryDao::createDaoUser();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_mapper->fromEntityToDto($this->_dao->updateUserProfile($this->_id, $this->_firstName,
			$this->_lastName, $this->_address, $this->_email, $this->_phone,$this->_modifier)));
	}

	/**
	 * @return DtoUser
	 */
	public function return () {
		return $this->getData();
	}
}