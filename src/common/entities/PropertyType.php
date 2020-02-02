<?php
class PropertyType extends Entity {
	private $_name;
	private $_image;

	/**
	 * PropertyType constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param string $image
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 */
	public function __construct (int $id, string $name, string $image, int $userCreator, int $userModifier,
		string $dateCreated, string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->_name = $name;
		$this->_image = $image;
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
	public function getImage () {
		return $this->_image;
	}

	/**
	 * @param string $image
	 */
	public function setImage ($image):void {
		$this->_image = $image;
	}
}