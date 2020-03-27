<?php
class CommandGetAllAccess extends Command {
	private $_builder;

	/**
	 * CommandGetAllAccess constructor.
	 */
	public function __construct () {
		$this->_builder = new ListAccessBuilder();
	}

	/**
	 * @throws AccessNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$dtoAccess = $this->_builder
									->getAll()
									->clean()
									->build();
		$this->setData($dtoAccess);
	}

	/**
	 * @return DtoAccess[]
	 */
	public function return () {
		return $this->getData();
	}
}