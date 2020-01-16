<?php
class GetPropertyByIdCommand extends Command {
	/**
	 * GetPropertyByIdCommand constructor.
	 *
	 * @param Property $property
	 */
	public function __construct ($property) {
		$this->_dao = FactoryDao::createDaoProperty($property);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getPropertyById());
	}

	/**
	 * @return Property
	 */
	public function return ():Property {
		return $this->getData();
	}
}