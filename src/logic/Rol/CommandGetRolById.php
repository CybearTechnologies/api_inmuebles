<?php
class CommandGetRolById extends Command {
	private $_rolBuilder;
	private $_id;

	/**
	 * CommandGetRolById constructor.
	 *
	 * @param int $id
	 */
	public function __construct ($id) {
		$this->_rolBuilder = new RolBuilder();
		$this->_id = $id;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RolNotFoundException
	 */
	public function execute ():void {
		$dtoRol = $this->_rolBuilder->getMinimumById($this->_id)->clean()->build();
		$this->setData($dtoRol);
	}

	/**
	 * @return DtoRol
	 */
	public function return () {
		return $this->getData();
	}
}