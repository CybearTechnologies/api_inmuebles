<?php
class CommandListProperties extends Command {
	private $_listBuilder;
	private $_loggedUser;

	/**
	 * CommandListProperties constructor.
	 *
	 * @param int $loggedUser
	 */
	public function __construct (int $loggedUser) {
		$this->_listBuilder = new ListPropertyBuilder();
		$this->_loggedUser = $loggedUser;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$dtoProperties = $this->_listBuilder
			->getAll($this->_loggedUser)
			->withExtras()
			->withType()
			->withLocation()
			->withLastTwoPrices()
			->withUserCreator()
			->unsetUserModifier()
			->build();
		$this->setData($dtoProperties);
	}

	/**
	 * @return DtoProperty[]
	 **/
	public function return () {
		return $this->getData();
	}
}