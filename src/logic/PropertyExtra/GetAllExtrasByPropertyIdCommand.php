<?php
class GetAllExtrasByPropertyIdCommand extends Command {
	private $_mapperPropExtra;
	private $_propertyId;

	/**
	 * GetAllExtrasByPropertyIdCommand constructor.
	 *
	 * @param int $property
	 */
	public function __construct (int $property) {
		$this->_dao = FactoryDao::createDaoPropertyExtra();
		$this->_mapperPropExtra = FactoryMapper::createMapperPropertyExtra();
		$this->_propertyId = $property;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 * @throws PropertyExtraNotFoundException
	 */
	public function execute ():void {
		$dtoPropertyExtra = $this->_mapperPropExtra->fromEntityArrayToDtoArray($this->_dao->getPropertyExtraByPropertyId($this->_propertyId));
		//SET EXTRA
		foreach ($dtoPropertyExtra as $item) {
			$command = FactoryCommand::createCommandGetExtraById(FactoryEntity::createExtra($item->extra));
			$command->execute();
			$item->extra = $command->return();
		}
		$this->setData($dtoPropertyExtra);
	}

	/**
	 * @return DtoPropertyExtra[]
	 */
	public function return () {
		return $this->getData();
	}
}