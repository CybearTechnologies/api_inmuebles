<?php
class GetAllExtrasByPropertyIdCommand extends Command {
	/**
	 * GetAllExtrasByPropertyIdCommand constructor.
	 *
	 * @param PropertyExtra $property
	 */
	public function __construct ($property) {
		$this->_dao = FactoryDao::createDaoPropertyExtra($property);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyExtraNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getPropertyExtraByPropertyId());
	}

	/**
	 * @return Extra[]
	 */
	public function return () {
		return $this->getData();
	}
}