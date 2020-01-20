<?php
class PropertyType extends Entity {
	private $_name;

	/**
	 * PropertyType constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $user
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, string $name, bool $active, bool $delete, int $userCreator,
		int $userModifier, string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->_name = $name;
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
	 * @return int
	 */
	public function getUser ():int {
		return $this->_user;
	}

	/**
	 * @param int $user
	 */
	public function setUser (int $user):void {
		$this->_user = $user;
	}
}