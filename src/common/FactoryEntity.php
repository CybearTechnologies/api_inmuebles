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
	 * @param int    $id
	 * @param string $name
	 *
	 * @return Agency
	 */
	static function createAgency (int $id, $name = '') {
		return new Agency($id, $name);
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
	 * @param int    $id
	 * @param string $name
	 * @param string $type
	 *
	 * @return Location
	 */
	static function createLocation ($id, $name = '', $type = '') {
		return new Location($id, $name, $type);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param string $rif
	 *
	 * @return Seat
	 */
	static function createSeat (int $id, $name = '', $rif = '') {
		return new Seat($id, $name, $rif);
	}

	/**
	 * @param int    $id
	 * @param string $date
	 *
	 * @return Request
	 */
	static function createRequest (int $id, $date = '') {
		return new Request($id, $date);
	}

	/**
	 * @param int    $id
	 * @param int    $price
	 * @param string $date
	 * @param bool   $final
	 *
	 * @return PropertyPrice
	 */
	static function createPropertyPrice (int $id, $price = 0, $date = '', $final = false):PropertyPrice {
		return new PropertyPrice($id, $price, $date, $final);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param int    $area
	 * @param string $description
	 * @param string $publishDate
	 * @param string $state
	 * @param int    $floor
	 *
	 * @return Property
	 */
	static function createProperty (int $id, $name = '', $area = 0, $description = '',
		$publishDate = '', $state = '', $floor = 0) {
		return new Property($id, $name, $area, $description, $publishDate, $state, $floor);
	}

	/**
	 * @param int    $id
	 * @param string $firstName
	 * @param string $lastName
	 * @param string $address
	 * @param string $email
	 * @param string $password
	 * @param string $delete
	 * @param string $blocked
	 *
	 * @return User
	 */
	static function createUser (int $id, $firstName = '', $lastName = '', $address = '', $email = '', $password = '',
		$delete = '', $blocked = '') {
		return new User($id, $firstName, $lastName, $address, $email, $password, $delete, $blocked);
	}
}