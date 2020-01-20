<?php
/**
 * Class PropertyPrice
 */
class PropertyPrice extends Entity {
	private $_price;
	private $_final;
	private $_propertyId;

	/**
	 * PropertyPrice constructor.
	 *
	 * @param int    $id
	 * @param float  $price
	 * @param bool   $final
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param int    $propertyId
	 */
	public function __construct (int $id, float $price, bool $final, int $propertyId, bool $active, bool $delete,
		int $userCreator, int $userModifier,
		string $dateCreated, string $dateModified) {
		parent::__construct($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
		$this->_price = $price;
		$this->_final = $final;
		$this->_propertyId = $propertyId;
	}

	/**
	 * @return float
	 */
	public function getPrice ():float {
		return $this->_price;
	}

	/**
	 * @param float $price
	 */
	public function setPrice (float $price):void {
		$this->_price = $price;
	}

	/**
	 * @return bool
	 */
	public function isFinal ():bool {
		return $this->_final;
	}

	/**
	 * @param bool $final
	 */
	public function setFinal (bool $final):void {
		$this->_final = $final;
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