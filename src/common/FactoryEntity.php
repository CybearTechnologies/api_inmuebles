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
	 * @param string $image
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 *
	 * @return PropertyType
	 */
	static function createPropertyType (int $id, string $name = Values::DEFAULT_STRING,
		string $image = Values::DEFAULT_STRING, int $userCreator = Values::DEFAULT_FOREIGN,
		int $userModifier = Values::DEFAULT_FOREIGN, string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE, bool $active = Values::DEFAULT_ACTIVE,
		bool $delete = Values::DEFAULT_DELETE):PropertyType {
		return new PropertyType($id, $name, $image, $userCreator, $userModifier, $dateCreated, $dateModified, $active,
			$delete);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param float  $price
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return Plan
	 */
	static function createPlan (int $id, string $name = Values::DEFAULT_STRING, float $price = Values::DEFAULT_FLOAT,
		int $userCreator = Values::DEFAULT_FOREIGN, int $userModifier = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):Plan {
		return new Plan($id, $name, $price, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
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
	static function createAgency (int $id, $name = Values::DEFAULT_STRING, int $userCreator = Values::DEFAULT_FOREIGN,
		int $userModifier = Values::DEFAULT_FOREIGN, string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):Agency {
		return new Agency($id, $name, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
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
	 * @param string $icon
	 *
	 * @return Extra
	 */
	static function createExtra (int $id, string $name = Values::DEFAULT_STRING, string $icon = Values::DEFAULT_STRING,
		int $userCreator = Values::DEFAULT_FOREIGN, int $userModifier = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):Extra {
		return new Extra($id, $name, $icon, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param string $type
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 *
	 * @return Location
	 */
	static function createLocation (int $id, string $name = Values::DEFAULT_STRING,
		string $type = Values::DEFAULT_STRING, int $userCreator = Values::DEFAULT_FOREIGN,
		int $userModifier = Values::DEFAULT_FOREIGN, string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE, bool $active = Values::DEFAULT_ACTIVE,
		bool $delete = Values::DEFAULT_DELETE):Location {
		return new Location($id, $name, $type, $userCreator, $userModifier, $dateCreated, $dateModified, $active,
			$delete);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param string $rif
	 * @param int    $location
	 * @param int    $agency
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 *
	 * @return Seat
	 */
	static function createSeat (int $id, string $name = Values::DEFAULT_STRING, string $rif = Values::DEFAULT_STRING,
		int $location = Values::DEFAULT_INT, int $agency = Values::DEFAULT_INT,
		int $userCreator = Values::DEFAULT_FOREIGN, int $userModifier = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):Seat {
		return new Seat($id, $name, $rif, $location, $agency, $userCreator, $userModifier, $dateCreated, $dateModified,
			$active, $delete);
	}

	/**
	 * @param int    $id
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $property
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return Request
	 */
	static function createRequest (int $id, int $property = Values::DEFAULT_INT,
		int $userCreator = Values::DEFAULT_FOREIGN, int $userModifier = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):Request {
		return new Request($id, $property, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
	}

	/**
	 * @param int    $id
	 * @param float  $price
	 * @param bool   $final
	 * @param int    $property
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 *
	 * @return PropertyPrice
	 */
	static function createPropertyPrice (int $id, float $price = Values::DEFAULT_FLOAT,
		bool $final = false, int $property = Values::DEFAULT_FOREIGN, int $userCreator = Values::DEFAULT_FOREIGN,
		int $userModifier = Values::DEFAULT_FOREIGN, string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE, $active = Values::DEFAULT_ACTIVE,
		$delete = Values::DEFAULT_DELETE):PropertyPrice {
		return new PropertyPrice($id, $price, $final, $property, $userCreator, $userModifier, $dateCreated,
			$dateModified, $active, $delete);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param float  $area
	 * @param string $description
	 * @param int    $state
	 * @param int    $floor
	 * @param int    $type
	 * @param int    $location
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
		$type = 0, $location = 0, $active = true, $delete = false, $userCreator = 0, $userModifier = 0,
		string $dateCreated = "", string $dateModified = ""):Property {
		return new Property($id, $name, $area, $description, $state, $floor, $type, $location, $active, $delete,
			$userCreator, $userModifier, $dateCreated, $dateModified);
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
	static function createUser (int $id,
		string $firstName = "",
		string $lastName = "",
		string $address = "",
		string $email = "",
		string $password = "",
		int $userCreator = 1,
		int $userModifier = 1,
		bool $active = true,
		bool $blocked = false,
		bool $deleted = false,
		int $seat = 1,
		int $rol = 1,
		int $plan = 1,
		int $location = 1,
		string $dateCreated = "",
		string $dateModified = ""):User {
		return new User($id, $firstName, $lastName, $address, $email, $password, $userCreator, $userModifier, $active,
			$blocked, $deleted, $seat, $rol, $plan, $location, $dateCreated, $dateModified);
	}

	/**
	 * @param int    $id
	 * @param float  $score
	 * @param string $message
	 * @param int    $user
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return Rating
	 */
	static function createRating (int $id, $score = Values::DEFAULT_FLOAT, $message = Values::DEFAULT_STRING,
		$user = Values::DEFAULT_FOREIGN, int $userCreator = Values::DEFAULT_INT,
		int $userModifier = Values::DEFAULT_INT, string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE, bool $active = Values::DEFAULT_ACTIVE,
		bool $delete = Values::DEFAULT_DELETE):Rating {
		return new Rating($id, $score, $message, $user, $userCreator, $userModifier, $dateCreated, $dateModified,
			$active, $delete);
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
	static function createAccess (int $id, $name = Values::DEFAULT_STRING, $abbreviation = Values::DEFAULT_STRING,
		int $userCreator = Values::DEFAULT_INT, int $userModifier = Values::DEFAULT_INT,
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):Access {
		return new Access($id, $name, $abbreviation, $userCreator, $userModifier, $dateCreated, $dateModified, $active,
			$delete);
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
	static function createRol (int $id, $name = Values::DEFAULT_STRING, int $userCreator = Values::DEFAULT_FOREIGN,
		int $userModifier = Values::DEFAULT_FOREIGN, string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE, bool $active = Values::DEFAULT_ACTIVE,
		bool $delete = Values::DEFAULT_DELETE):Rol {
		return new Rol($id, $name, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
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

	/**
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
	 *
	 * @return PropertyExtra
	 */
	static function createPropertyExtra (int $id, int $value = Values::DEFAULT_INT,
		int $propertyId = Values::DEFAULT_FOREIGN, int $extraId = Values::DEFAULT_FOREIGN,
		int $userCreator = Values::DEFAULT_FOREIGN, int $userModifier = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):PropertyExtra {
		return new PropertyExtra($id, $value, $propertyId, $extraId, $userCreator, $userModifier,
			$dateCreated, $dateModified, $active, $delete);
	}
}