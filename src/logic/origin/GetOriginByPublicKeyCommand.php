<?php
class GetOriginByPublicKeyCommand extends Command {
	private $_publicKey;

	/**
	 * GetOriginByPublicKeyCommand constructor.
	 *
	 * @param $publicKey
	 */
	public function __construct ($publicKey) {
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