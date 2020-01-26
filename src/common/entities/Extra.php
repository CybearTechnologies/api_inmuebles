<?php
class Extra extends Entity {
	private $_name;
	private $_value;
	private $_icon;

	/**
	 * Extra constructor.
	 *
	 * @param int    $id
	 * @param string $name
	 * @param string $icon
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param float  $value
	 */
	public function __construct (int $id, string $name, string $icon,bool $active, bool $delete, int $userCreator,
								 int $userModifier, string $dateCreated, string $dateModified,
								 float $value) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified,
							$active, $delete);
		$this->_name = $name;
		$this->_value = $value;
		$this->_icon = $icon;
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
	 * @return float
	 */
	public function getValue ():float {
		return $this->_value;
	}

	/**
	 * @param float $value
	 */
	public function setValue (float $value):void {
		$this->_value = $value;
	}

	/**
	 * @return mixed
	 */
	public function getIcon () {
		return $this->_icon;
	}

	/**
	 * @param mixed $icon
	 */
	public function setIcon ($icon):void {
		$this->_icon = $icon;
	}

}