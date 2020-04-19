<?php
class CommandGetLocationById extends Command {
	private $_builder;
	private $_id;

	/**
	 * CommandGetLocationById constructor.
	 *
	 * @param int $id
	 */
	public function __construct ($id) {
		$this->_builder = new LocationBuilder();
		$this->_id = $id;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 */
	public function execute ():void {
		$dtoLocation = $this->_builder->getMinimumById($this->_id)->clean()->build();
		$this->setData($dtoLocation);
	}

	/**
	 * @return DtoLocation
	 */
	public function return () {
		return $this->getData();
	}
}
