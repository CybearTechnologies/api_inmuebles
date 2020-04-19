<?php
class CommandGetPropertyDetail extends Command {
	private $_propertyBuilder;
	private $_id;

	/**
	 * CommandGetPropertyDetail constructor.
	 *
	 * @param int $id
	 */
	public function __construct (int $id) {
		$this->_propertyBuilder = new PropertyBuilder();
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws PropertyNotFoundException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$dtoProperty = $this->_propertyBuilder
			->getMinimumById($this->_id)
			->withExtras()
			->withUserDetail()
			->withAllPrices()
			->clean()
			->build();
		$this->setData($dtoProperty);
	}

	/**@return DtoProperty */
	public function return () {
		return $this->getData();
	}
}