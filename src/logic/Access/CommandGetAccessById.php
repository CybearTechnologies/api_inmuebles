<?php
class CommandGetAccessById extends Command {
	private $_builder;
	private $_id;

	/**
	 * CommandGetAccessById constructor.
	 *
	 * @param $id
	 */
	public function __construct ($id) {
		$this->_builder = new AccessBuilder();
		$this->_id = $id;
	}

	/**
	 * @throws AccessNotFoundException
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$dtoAccess = $this->_builder
							->getMinimumById($this->_id)
							->build();
		$this->setData($dtoAccess);
	}

	/**
	 * @return DtoAccess
	 */
	public function return ():DtoAccess {
		return $this->getData();
	}
}