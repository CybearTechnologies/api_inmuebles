<?php
class CommandGetAllPendingRequest extends Command {
	private $_id;
	private $_builder;

	/**
	 * CommandGetAllPendingRequest constructor.
	 *
	 * @param $id
	 */
	public function __construct ($id) {
		$this->_builder = new ListPropertyRequestBuilder();
		$this->_id = $id;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$dtoRequest = $this->_builder
			->getPendingRequest($this->_id)
			->withProperty()
			->withUser()
			->build();
		$this->setData($dtoRequest);
	}

	/**
	 * @return DtoRequest[]
	 */
	public function return () {
		return $this->getData();
	}
}