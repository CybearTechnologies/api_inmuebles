<?php
/**
 * Generated by Houston
 * Date: 19-Nov-19
 * Time: 12:29 PM
 */
class FactoryEntity {
	/**
	 * @param int    $id
	 * @param string $name
	 *
	 * @return PropertyType
	 */
	static function createPropertyType (int $id, $name = ''):PropertyType {
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
	 * @param Seat[] $seats
	 *
	 * @return Agency
	 */
	static function createAgency ($id, $name = '', $seats = []) {
		return new Agency($id, $name, $seats);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 *
	 * @return Extra
	 */
	static function createExtra (int $id, $name = ''):Extra {
		return new Extra($id, $name);
	}

	/**
	 * @param        $id
	 * @param string $name
	 * @param string $type
	 *
	 * @return Location
	 */
	static function createLocation($id,$name='',$type=''){
		return new Location($id,$name,$type);
	}

	/**
	 * @param        $id
	 * @param string $name
	 * @param        $rif
	 *
	 * @return Seat
	 */
	static function createSeat ($id = 0, $name = '', $rif = '') {
		return new Seat($id, $name, $rif);
	}

	static function createRequest ($id, $date = '') {
		return new Request($id, $date);
	}
}