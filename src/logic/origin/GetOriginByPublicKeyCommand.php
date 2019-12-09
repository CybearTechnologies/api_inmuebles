<?php
class GetOriginByPublicKeyCommand extends Command {
	private $_origin;

	/**
	 * GetOriginByPublicKeyCommand constructor.
	 *
	 * @param Origin $origin
	 */
	public function __construct (Origin $origin) {
		$this->_dao = FactoryDao::createDaoOrigin($origin);
		$this->_origin = $origin;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws OriginNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getOriginByPublicKey());
	}

	/**
	 * @return Origin
	 */
	public function return () {
		return $this->getData();
	}
}