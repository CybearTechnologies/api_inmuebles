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
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $user
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return PropertyType
	 */
	static function createPropertyType (int $id, $name = "", $active = true, $delete = false, int $user = 1,
		int $userCreator = 1, int $userModifier = 1, string $dateCreated = "", string $dateModified = ""):PropertyType {
		return new PropertyType($id, $name, $active, $delete, $user, $userCreator, $userModifier, $dateCreated,
			$dateModified);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param int    $price
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return Plan
	 */
	static function createPlan (int $id, string $name = "", float $price = 0, bool $active = true, bool $delete = false,
		int $userCreator = 1, int $userModifier = 1, string $dateCreated = "", string $dateModified = ""):Plan {
		return new Plan($id, $name, $price, $active, $delete, $userCreator, $userModifier, $dateCreated, $dateModified);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return Agency
	 */
	static function createAgency (int $id, $name = "", $active = true, $delete = false, int $userCreator = 0,
		int $userModifier = 0, string $dateCreated = "", string $dateModified = ""):Agency {
		return new Agency($id, $name, $active, $delete, $userCreator, $userModifier, $dateCreated, $dateModified);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return Extra
	 */
	static function createExtra (int $id, $name = "", $active = true, $delete = false, int $userCreator = 0,
		int $userModifier = 0, string $dateCreated = "", string $dateModified = ""):Extra {
		return new Extra($id, $name, $active, $delete, $userCreator, $userModifier, $dateCreated, $dateModified);
	}

	/**
	 * @param        $id
	 * @param string $name
	 * @param string $type
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return Location
	 */
	static function createLocation ($id, $name = "", $type = "", $active = true, $delete = false, int $userCreator = 0,
		int $userModifier = 0, string $dateCreated = "", string $dateModified = ""):Location {
		return new Location($id, $name, $type, $active, $delete, $userCreator, $userModifier, $dateCreated,
			$dateModified);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param string $rif
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return Seat
	 */
	static function createSeat (int $id, $name = "", $rif = "", $active = true, $delete = false, int $userCreator = 0,
		int $userModifier = 0, string $dateCreated = "", string $dateModified = ""):Seat {
		return new Seat($id, $name, $rif, $active, $delete, $userCreator, $userModifier, $dateCreated, $dateModified);
	}

	/**
	 * @param int    $id
	 * @param string $date
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return Request
	 */
	static function createRequest (int $id, $date = "", $active = true, $delete = false, int $userCreator = 0,
		int $userModifier = 0, string $dateCreated = "", string $dateModified = ""):Request {
		return new Request($id, $date, $active, $delete, $userCreator, $userModifier, $dateCreated, $dateModified);
	}

	/**
	 * @param int    $id
	 * @param int    $price
	 * @param string $date
	 * @param bool   $final
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return PropertyPrice
	 */
	static function createPropertyPrice (int $id, $price = 0, $date = "", $final = false, $active = true,
		$delete = false, int $userCreator = 0, int $userModifier = 0, string $dateCreated = "",
		string $dateModified = ""):PropertyPrice {
		return new PropertyPrice($id, $price, $date, $final, $active, $delete, $userCreator, $userModifier,
			$dateCreated, $dateModified);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param float  $area
	 * @param string $description
	 * @param int    $state
	 * @param int    $floor
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return Property
	 */
	static function createProperty (int $id, $name = "", $area = 0.0, $description = "", $state = 0, $floor = 0,
		$active = true, $delete = false, $userCreator = 0, $userModifier = 0, string $dateCreated = "",
		string $dateModified = ""):Property {
		return new Property($id, $name, $area, $description, $state, $floor, $active, $delete, $userCreator,
			$userModifier, $dateCreated, $dateModified);
	}

	/**
	 * @param int    $id
	 * @param string $firstName
	 * @param string $lastName
	 * @param string $address
	 * @param string $email
	 * @param string $password
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param bool   $active
	 * @param bool   $blocked
	 * @param bool   $deleted
	 * @param int    $seat
	 * @param int    $rol
	 * @param int    $plan
	 * @param int    $location
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return User
	 */
	static function createUser (int $id, string $firstName = "", string $lastName = "", string $address = "",
		string $email = "",
		string $password = "", int $userCreator = 1, int $userModifier = 1, bool $active = true, bool $blocked = false,
		bool $deleted = false,
		int $seat = 1, int $rol = 1, int $plan = 1, int $location = 1, string $dateCreated = "",
		string $dateModified = ""):User {
		return new User($id, $firstName, $lastName, $address, $email, $password, $userCreator, $userModifier, $active,
			$blocked, $deleted, $seat, $rol, $plan, $location, $dateCreated, $dateModified);
	}

	/**
	 * @param int    $id
	 * @param float  $score
	 * @param string $message
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return Rating
	 */
	static function createRating (int $id, $score = 0.0, $message = "", $active = true, $delete = false,
		int $userCreator = 0, int $userModifier = 0, string $dateCreated = "", string $dateModified = ""):Rating {
		return new Rating($id, $score, $message, $active, $delete, $userCreator, $userModifier, $dateCreated,
			$dateModified);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param string $abbreviation
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return Access
	 */
	static function createAccess (int $id, $name = "", $abbreviation = "", $active = true, $delete = false,
		int $userCreator = 1, int $userModifier = 1, $dateCreated = "", $dateModified = ""):Access {
		return new Access($id, $name, $abbreviation, $active, $delete, $userCreator, $userModifier, $dateCreated,
			$dateModified);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return Rol
	 */
	static function createRol (int $id, $name = "", $active = true, $delete = false, $userCreator = 0,
		$userModifier = 0,
		$dateCreated = "", $dateModified = ""):Rol {
		return new Rol($id, $name, $active, $delete, $userCreator, $userModifier, $dateCreated, $dateModified);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param string $privateKey
	 * @param string $publicKey
	 * @param bool   $active
	 *
	 * @return Origin
	 */
	static function createOrigin (int $id, string $name = '', string $privateKey = '', string $publicKey = '',
		bool $active = true):Origin {
		return new Origin($id, $name, $privateKey, $publicKey, $active);
	}
}