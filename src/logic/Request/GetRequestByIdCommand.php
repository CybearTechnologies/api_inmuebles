<?php
class GetRequestByIdCommand extends Command {
	private $_dao;

	/**
	 * GetRequestByIdCommand constructor.
	 *
	 * @param Request $request
	 */
	public function __construct ($request) {
		$this->_dao = FactoryDao::createDaoRequest($request);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws RequestNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getRequestById());
	}

	/**
	 * @return Request
	 */
	public function return () {
		return $this->getData();
	}
}