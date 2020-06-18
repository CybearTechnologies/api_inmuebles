<?php
class CommandDeleteExtrasByPropertyId extends Command {
	private $_id;
	private $_userModifier;
	private $_dateModified;
	private $_mapper;

	/**
	 * CommandDeleteExtrasByPropertyId constructor.
	 *
	 * @param int    $id
	 * @param int    $userModifier
	 * @param string $dateModified
	 */
	public function __construct (int $id, int $userModifier, string $dateModified) {
		$this->_id = $id;
		$this->_userModifier = $userModifier;
		$this->_dateModified = $dateModified;
		$this->_mapper = FactoryMapper::createMapperPropertyExtra();
		$this->_dao = FactoryDao::createDaoPropertyExtra();
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->_dao->deleteExtrasByPropertyId($this->_id, $this->_userModifier, $this->_dateModified);
	}

	public function return () {
	}
}