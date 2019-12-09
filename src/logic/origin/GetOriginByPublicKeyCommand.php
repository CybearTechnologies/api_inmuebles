<?php
class GetOriginByPublicKeyCommand extends Command {
	private $_dao;
	private $_publicKey;

	/**
	 * GetOriginByPublicKeyCommand constructor.
	 *
	 * @param string $publicKey
	 */
	public function __construct (string $publicKey) {
		$this->_dao = FactoryDao::createDaoOrigin();
		$this->_publicKey = $publicKey;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws OriginNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getOriginByPublicKey($this->_publicKey));
	}

	/**
	 * @return Origin
	 */
	public function return () {
		return $this->getData();
	}
}