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
	 * @param int    $active
	 *
	 * @return PropertyType
	 */
	static function createPropertyType (int $id, $name = '', $active = 1):PropertyType {
		return new PropertyType($id, $name, $active);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param int    $price
	 * @param int    $active
	 *
	 * @return Plan
	 */
	static function createPlan (int $id, $name = '', $price = 0, $active = 1) {
		return new Plan($id, $name, $price, $active);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param int    $active
	 *
	 * @return Agency
	 */
	static function createAgency (int $id, $name = '', $active = 1) {
		return new Agency($id, $name, $active);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param int    $active
	 *
	 * @return Extra
	 */
	static function createExtra (int $id, $name = '', $active = 1):Extra {
		return new Extra($id, $name, $active);
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
	 * @param int    $active
	 *
	 * @return Seat
	 */
	static function createSeat (int $id, $name = '', $rif = '', $active = 1) {
		return new Seat($id, $name, $rif, $active);
	}

	/**
	 * @param int    $id
	 * @param string $date
	 * @param int    $active
	 *
	 * @return Request
	 */
	static function createRequest (int $id, $date = '', $active = 1) {
		return new Request($id, $date, $active);
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
	 * @param int    $state
	 * @param int    $floor
	 *
	 * @return Property
	 */
	static function createProperty (int $id, $name = '', $area = 0, $description = '',
		$publishDate = '', $state = 1, $floor = 0) {
		return new Property($id, $name, $area, $description, $publishDate, $state, $floor);
	}

	/**
	 * @param int    $id
	 * @param string $firstName
	 * @param string $lastName
	 * @param string $address
	 * @param string $email
	 * @param string $password
	 * @param int    $delete
	 * @param int    $blocked
	 *
	 * @return User
	 */
	static function createUser (int $id, $firstName = '', $lastName = '', $address = '', $email = '', $password = '',
		$delete = 0, $blocked = 0) {
		return new User($id, $firstName, $lastName, $address, $email, $password, $delete, $blocked);
	}

	/**
	 * @param int    $id
	 * @param string $score
	 * @param string $message
	 * @param int    $active
	 *
	 * @return Rating
	 */
	static function createRating (int $id, $score = '', $message = '', $active = 1) {
		return new Rating($id, $score, $message, $active);
	}
}