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
	 * @throws PropertyNotFoundException
	 */
	public function execute ():void {
		$dtoProperties = $this->_listBuilder
											->getAll()
											->withExtras()
											->withLocation()
											->withType()
											->withLastTwoPrices()
											->clean()
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