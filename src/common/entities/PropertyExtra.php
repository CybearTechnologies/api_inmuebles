<?php
class PropertyExtra extends Entity {
	private $_amount;
	private $_propertyId;

	/**
	 * PropertyExtra constructor.
	 *
	 * @param int    $id
	 * @param int    $value
	 * @param int    $propertyId
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 */
	public function __construct (int $id, int $value, int $propertyId, bool $active, bool $delete,
		int $userCreator, int $userModifier, string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->_amount = $value;
		$this->_propertyId = $propertyId;
	}

	/**
	 * @return int
	 */
	public function getAmount ():int {
		return $this->_amount;
	}

	/**
	 * @param int $value
	 */
	public function setAmount (int $value):void {
		$this->_amount = $value;
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