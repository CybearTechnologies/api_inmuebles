<?php
class CommandGetPropertyById extends Command {
	private $_builderProperty;
	private $_id;
	private $_loggerUser;

	/**
	 * CommandGetPropertyById constructor.
	 *
	 * @param int $property
	 * @param     $loggedUser
	 */
	public function __construct ($property,$loggedUser) {
		$this->_builderProperty = new PropertyBuilder($loggedUser);
		$this->_id = $property;
		$this->_loggerUser = $loggedUser;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws PropertyNotFoundException
	 */
	public function execute ():void {
		$dtoProperty = $this->_builderProperty
												->getMinimumById($this->_id)
												->withExtras()
												->withPrice()
												->withUserDetail()
												->withLocation()
												->withLastTwoPrices()->withType()
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