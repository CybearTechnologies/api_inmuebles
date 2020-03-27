<?php
class CommandGetPropertyById extends Command {
	private $_builderProperty;
	private $_id;

	/**
	 * CommandGetPropertyById constructor.
	 *
	 * @param int $property
	 */
	public function __construct ($property) {
		$this->_builderProperty = new PropertyBuilder();
		$this->_id = $property;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws PropertyNotFoundException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$dtoProperty = $this->_builderProperty
			->getMinimumById($this->_id)
			->withExtras()
			->withPrice()
			->withUserDetail()
			->withLocation()
			->withLastTwoPrices()
			->clean()
			->build();
		$this->setData($dtoProperty);
	}

	/**
	 * @return DtoProperty
	 */
	public function return ():DtoProperty {
		return $this->getData();
	}
}