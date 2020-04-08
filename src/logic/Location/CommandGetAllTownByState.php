<?php
class CommandGetAllTownByState extends Command {
	private $_locationBuilder;
	private $_id;

	/**
	 * CommandGetAllTownByState constructor.
	 *
	 * @param int $id
	 */
	public function __construct (int $id) {
		$this->_locationBuilder = new ListLocationBuilder();
		$this->_id = $id;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws LocationNotFoundException
	 */
	public function execute ():void {
		$dtoLocation = $this->_locationBuilder
			->getByStateId($this->_id)
			->clean()
			->build();
		$this->setData($dtoLocation);
	}

	/**
	 * @return DtoLocation[]
	 */
	public function return () {
		return $this->getData();
	}
}