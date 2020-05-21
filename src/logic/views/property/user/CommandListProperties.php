<?php
class CommandListProperties extends Command {
	private $_listBuilder;

	/**
	 * CommandListProperties constructor.
	 */
	public function __construct () {
		$this->_listBuilder = new ListPropertyBuilder();
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