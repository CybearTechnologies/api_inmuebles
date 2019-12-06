<?php
class GetAllExtrasByPropertyIdCommand extends Command {
	private $_dao;

	/**
	 * GetAllExtrasByPropertyIdCommand constructor.
	 *
	 * @param Property $property
	 */
	public function __construct ($property) {
		$this->_dao = FactoryDao::createDaoExtra($property);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getAllPropertyExtra());
	}

	/**
	 * @return Extra[]
	 */
	public function return () {
		return $this->getData();
	}
}