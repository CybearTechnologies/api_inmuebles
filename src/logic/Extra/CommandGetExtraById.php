<?php
class CommandGetExtraById extends Command {
	private $_extraBuilder;
	private $_id;

	/**
	 * CommandGetExtraById constructor.
	 *
	 * @param int $extra
	 */
	public function __construct ($extra) {
		$this->_extraBuilder = new ExtraBuilder();
		$this->_id = $extra;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 * @throws MultipleUserException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$dtoExtra = $this->_extraBuilder->getMinimumById($this->_id)
										->withUsers()
										->clean()
										->build();
		$this->setData($dtoExtra);
	}

	/**
	 * @return DtoExtra
	 */
	public function return () {
		return $this->getData();
	}
}