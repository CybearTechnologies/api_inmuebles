<?php
class CommandGetAllUserProperties extends Command {
	private $_builder;
	private $_id;

	/**
	 * CommandGetAllUserProperties constructor.
	 *
	 * @param int $id
	 */
	public function __construct (int $id) {
		$this->_dao = FactoryDao::createDaoProperty();
		$this->_builder = new ListPropertyBuilder();
		$this->_id = $id;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function execute ():void {
		$dtoProperty = $this->_builder
			->getMinimumById($this->_id)
			->withLocation()
			->withType()
			->withLastTwoPrices()
			->withExtras()
			->clean()
			->build();
		$this->setData($dtoProperty);
	}

	/**
	 * @return DtoProperty[]
	 */
	public function return () {
		return $this->getData();
	}
}