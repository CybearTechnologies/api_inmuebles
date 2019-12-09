<?php
class Origin extends Entity {
	private $_name;
	private $_privateKey;
	private $_publicKey;
	private $_active;

	/**
	 * Origin constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param string $privateKey
	 * @param string $publicKey
	 * @param bool   $active
	 */
	public function __construct (int $id, string $name, string $privateKey, string $publicKey, bool $active) {
		$this->setId($id);
		$this->_name = $name;
		$this->_privateKey = $privateKey;
		$this->_publicKey = $publicKey;
		$this->_active = $active;
	}

	/**
	 * @return string
	 */
	public function getName ():string {
		return $this->_name;
	}

	/**
	 * @param string $name
	 */
	public function setName (string $name):void {
		$this->_name = $name;
	}

	/**
	 * @return string
	 */
	public function getPrivateKey ():string {
		return $this->_privateKey;
	}

	/**
	 * @param string $privateKey
	 */
	public function setPrivateKey (string $privateKey):void {
		$this->_privateKey = $privateKey;
	}

	/**
	 * @return string
	 */
	public function getPublicKey ():string {
		return $this->_publicKey;
	}

	/**
	 * @param string $publicKey
	 */
	public function setPublicKey (string $publicKey):void {
		$this->_publicKey = $publicKey;
	}

	/**
	 * @return bool
	 */
	public function isActive ():bool {
		return $this->_active;
	}

	/**
	 * @param bool $active
	 */
	public function setActive (bool $active):void {
		$this->_active = $active;
	}
}