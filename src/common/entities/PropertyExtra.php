<?php
class PropertyExtra extends Entity {
	private $_value;
	private $_extraId;
	private $_propertyId;

	/**
	 * PropertyExtra constructor.
	 *
	 * @param int    $id
	 * @param int    $value
	 * @param int    $propertyId
	 * @param int    $extraId
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 */
	public function __construct (int $id, int $value, int $propertyId, int $extraId, int $userCreator,
		int $userModifier, string $dateCreated, string $dateModified, bool $active, bool $delete) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->_value = $value;
		$this->_propertyId = $propertyId;
		$this->_extraId = $extraId;
	}

	/**
	 * @return int
	 */
	public function getValue ():int {
		return $this->_value;
	}

	/**
	 * @param int $value
	 */
	public function setValue (int $value):void {
		$this->_value = $value;
	}

	/**
	 * @return int
	 */
	public function getExtraId ():int {
		return $this->_extraId;
	}

	/**
	 * @param int $extraId
	 */
	public function setExtraId (int $extraId):void {
		$this->_extraId = $extraId;
	}

	/**
	 * @return int
	 */
	public function getPropertyId ():int {
		return $this->_propertyId;
	}

	/**
	 * @param int $propertyId
	 */
	public function setPropertyId (int $propertyId):void {
		$this->_propertyId = $propertyId;
	}
}