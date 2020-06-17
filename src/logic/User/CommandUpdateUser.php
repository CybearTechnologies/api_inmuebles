<?php
class CommandUpdateUser extends Command {
	private $_id;
	private $_firstName;
	private $_lastName;
	private $_address;
	private $_email;
	private $_seat;
	private $_plan;
	private $_location;
	private $_userModifier;
	private $_dateModified;

	/**
	 * CommandUpdateUser constructor.
	 *
	 * @param $id
	 * @param $firstName
	 * @param $lastName
	 * @param $address
	 * @param $email
	 * @param $seat
	 * @param $plan
	 * @param $location
	 * @param $userModifier
	 * @param $dateModified
	 */
	public function __construct ($id, $firstName, $lastName, $address, $email, $seat, $plan, $location, $userModifier,
		$dateModified) {
		$this->_dao = FactoryDao::createDaoUser();
		$this->_id = $id;
		$this->_firstName = $firstName;
		$this->_lastName = $lastName;
		$this->_address = $address;
		$this->_email = $email;
		$this->_seat = $seat;
		$this->_plan = $plan;
		$this->_location = $location;
		$this->_userModifier = $userModifier;
		$this->_dateModified = $dateModified;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->updateUser($this->_id, $this->_firstName, $this->_lastName, $this->_address,
			$this->_email, $this->_seat, $this->_plan, $this->_location, $this->_userModifier, $this->_dateModified));
	}

	/**
	 * @return User
	 */
	public function return () {
		return $this->getData();
	}
}