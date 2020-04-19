<?php
class CommandCreateExtra extends Command {
	private $_name;
	private $_image;
	private $_user;

	/**
	 * CommandCreateExtra constructor.
	 *
	 * @param string $name
	 * @param string $image
	 * @param int    $user
	 */
	public function __construct (string $name, string $image, int $user) {
		$this->_dao = FactoryDao::createDaoExtra();
		$this->_name = $name;
		$this->_image = $image;
		$this->_user = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData($this->_dao->createExtra($this->_name, $this->_image, $this->_user));
	}

	/**
	 * @return Extra
	 */
	public function return () {
		return $this->getData();
	}
}