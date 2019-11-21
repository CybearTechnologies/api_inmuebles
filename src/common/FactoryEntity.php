<?php
/**
 * Generated by Houston
 * Date: 19-Nov-19
 * Time: 12:29 PM
 */
require_once __DIR__ . "/../../autoload.php";
class FactoryEntity {
	/**
	 * @param        $id
	 * @param string $name
	 *
	 * @return PropertyType
	 */
	static function createPropertyType ($id, $name = ''):PropertyType {
		return new PropertyType($id, $name);
	}

	/**
	 * @param $id
	 * @param $name
	 * @param $price
	 *
	 * @return Plan
	 */
	static function createPlan ($id, $name, $price) {
		return new Plan($id, $name, $price);
	}

	/**
	 * @param        $id
	 * @param string $name
	 *
	 * @return Agency
	 */
	static function createAgency ($id, $name = '') {
		return new Agency($id, $name);
	}

	/**
	 * @param        $id
	 * @param string $name
	 *
	 * @return Extra
	 */
	static function createExtra ($id, $name = '') {
		return new Extra($id, $name);
	}

	/**
	 * @param        $id
	 * @param string $name
	 *
	 * @return Seat
	 */
	static function createSeat ($id, $name = '') {
		return new Seat($id, $name);
	}
}