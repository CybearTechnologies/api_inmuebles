<?php
class CommandGetAllExtra extends Command {
	private $_builder;

	/**
	 * CommandGetAllExtra constructor.
	 */
	public function __construct () {
		$this->_builder = new ListExtraBuilder();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function execute ():void {
		$dtoExtra = $this->_builder->getAll()
									->clean()
									->build();
		$this->setData($dtoExtra);
	}

	/**
	 * @return DtoExtra[]
	 */
	public function return () {
		return $this->getData();
	}
}