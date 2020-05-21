<?php
class CommandGetAllRequestByUserId extends Command {
	private $_problertyRequestBuilder;
	private $_userId;

	/**
	 * CommandGetAllRequestByUserId constructor.
	 *
	 * @param int $user
	 */
	public function __construct ($user) {
		$this->_problertyRequestBuilder = new ListPropertyRequestBuilder();
		$this->_userId = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->setData(
			$this->_problertyRequestBuilder
				->getUserRequest($this->_userId)
				->withProperty()
				->withUser()
				->unsetUserModifier()
				->build()
		);
	}

	/**
	 * @return DtoRequest[]
	 */
	public function return () {
		return $this->getData();
	}
}