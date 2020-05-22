<?php
class CommandListProperties extends Command {
	private $_listBuilder;

	/**
	 * CommandListProperties constructor.
	 *
	 * @param int $loggedUser
	 */
	public function __construct (int $loggedUser) {
		$this->_listBuilder = new ListPropertyBuilder($loggedUser);
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$dtoProperties = $this->_listBuilder
			->getAll()
			->withExtras()
			->withLocation()
			->withType()
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