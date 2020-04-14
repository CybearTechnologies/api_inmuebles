<?php
class CommandGetPropertyTypeById extends Command {
	private $_builder;
	private $_id;

	/**
	 * CommandGetPropertyTypeById constructor.
	 *
	 * @param int $id
	 */
	public function __construct ($id) {
		$this->_builder = new PropertyTypeBuilder();
		$this->_id = $id;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyTypeNotFoundException
	 */
	public function execute ():void {
		$dtoPropertyType = $this->_builder->getMinimumById($this->_id)->clean()->build();
		$this->setData($dtoPropertyType);
	}

	/**
	 * @return DtoPropertyType
	 */
	public function return ():DtoPropertyType {
		return $this->getData();
	}
}