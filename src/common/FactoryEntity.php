<?php
/**
 * Generated by Houston
 * Date: 19-Nov-19
 * Time: 12:29 PM
 */
class  FactoryEntity {
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
	 * @param string $icon
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 *
	 * @return Agency
	 */
	static function createAgency (int $id, $name = Values::DEFAULT_STRING, string $icon = Values::DEFAULT_STRING,
		int $userCreator = Values::DEFAULT_FOREIGN,
		int $userModifier = Values::DEFAULT_FOREIGN, string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):Agency {
		return new Agency($id, $name, $icon,$userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
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
	 * @param int    $property
	 * @param string $userCreator
	 * @param string $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 *
	 * @return Request
	 */
	static function createRequest (int $id, int $property = Values::DEFAULT_INT,
		string $userCreator = Values::DEFAULT_STRING, string $userModifier = Values::DEFAULT_STRING,
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
	 * @param        $destiny
	 * @param int    $favorite
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
	static function createProperty (int $id, $destiny,int $favorite=0,$name = "", $area = 0.0,$description = "", $state = 0, $floor = 0,
		$type = 0, $location = 0, $active = true, $delete = false, $userCreator = 0, $userModifier = 0,
		string $dateCreated = "", string $dateModified = ""):Property {
		return new Property($id,$destiny,$favorite,$name, $area, $description, $state, $floor, $type, $location, $active, $delete,
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
	 * @param string $seat
	 * @param string $rol
	 * @param string $plan
	 * @param string $location
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return User
	 */
	static function createUser (int $id,
		string $firstName = Values::DEFAULT_STRING,
		string $lastName = Values::DEFAULT_STRING,
		string $address = Values::DEFAULT_STRING,
		string $email = Values::DEFAULT_STRING,
		string $password = Values::DEFAULT_STRING,
		int $userCreator = Values::DEFAULT_FOREIGN,
		int $userModifier = Values::DEFAULT_FOREIGN,
		bool $active = Values::DEFAULT_ACTIVE,
		bool $blocked = Values::DEFAULT_INT,
		bool $deleted = Values::DEFAULT_DELETE,
		int $seat = Values::DEFAULT_FOREIGN,
		int $rol = Values::DEFAULT_FOREIGN,
		int $plan = Values::DEFAULT_FOREIGN,
		int $location = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE):User {
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
	 * @param string $name
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
	static function createPropertyExtra (int $id,
		int $value = Values::DEFAULT_INT,
		int $propertyId = Values::DEFAULT_FOREIGN, int $extraId = Values::DEFAULT_FOREIGN,
		int $userCreator = Values::DEFAULT_FOREIGN, int $userModifier = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):PropertyExtra {
		return new PropertyExtra($id, $value, $propertyId, $extraId, $userCreator, $userModifier,
			$dateCreated, $dateModified, $active, $delete);
	}

	/**
	 * @param int    $id
	 * @param int    $rol
	 * @param int    $access
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 *
	 * @return RolAccess
	 */
	static function createRolAccess (int $id,
		int $rol = Values::DEFAULT_FOREIGN,
		int $access = Values::DEFAULT_FOREIGN,
		int $userCreator = Values::DEFAULT_FOREIGN,
		int $userModifier = Values::DEFAULT_FOREIGN, string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE, bool $active = Values::DEFAULT_ACTIVE,
		bool $delete = Values::DEFAULT_DELETE):RolAccess {
		return new RolAccess($id, $rol, $access, $userCreator, $userModifier, $dateCreated, $dateModified,
			$active, $delete);
	}

	/**
	 * @param string $filename
	 *
	 * @return ResizeImage
	 * @throws FileIsNotImageException
	 * @throws ImageNotFoundException
	 */
	static function createResizeImage ($filename = null):ResizeImage {
		return new ResizeImage($filename);
	}

	/**
	 * @param int    $id
	 * @param int    $property
	 * @param string $userCreator
	 * @param string $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 *
	 * @return Favorite
	 */
	static function createFavorite (int $id, int $property = Values::DEFAULT_INT,
		int $userCreator = Values::DEFAULT_FOREIGN, string $userModifier = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):Favorite {
		return new Favorite($id, $property, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete);
	}

	/**
	 * @param int    $id
	 * @param string $firstName
	 * @param string $lastName
	 * @param string $address
	 * @param string $ci
	 * @param string $passport
	 * @param string $email
	 * @param string $password
	 * @param int    $plan
	 * @param int    $seat
	 * @param int    $location
	 * @param bool   $status
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 *
	 * @return Subscription
	 */
	static function createSubscription (int $id,string $firstName,string $lastName,string $address,
		string $ci = Values::DEFAULT_STRING, string $passport = Values::DEFAULT_STRING,
		string $email = Values::DEFAULT_STRING, string $password = Values::DEFAULT_STRING,
		int $plan = Values::DEFAULT_FOREIGN, int $seat = Values::DEFAULT_FOREIGN,
		int $location = Values::DEFAULT_FOREIGN, bool $status = Values::DEFAULT_STATUS,
		int $userCreator = Values::DEFAULT_FOREIGN, int $userModifier = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):Subscription {
		return new Subscription($id, $ci,$firstName,$lastName,$address, $passport, $email, $password,
			$plan, $seat, $location, $status, $userCreator, $userModifier, $dateCreated,
			$dateModified, $active, $delete);
	}

	/**
	 * @param int    $id
	 * @param int    $subscription
	 * @param string $document
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 *
	 * @return SubscriptionDetail
	 */
	static function createSubscriptionDetail (
		int $id, int $subscription = Values::DEFAULT_FOREIGN,
		string $document = Values::DEFAULT_STRING,
		int $userCreator = Values::DEFAULT_FOREIGN,
		int $userModifier = Values::DEFAULT_FOREIGN, string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE, bool $active = Values::DEFAULT_ACTIVE,
		bool $delete = Values::DEFAULT_DELETE):SubscriptionDetail {
		return new SubscriptionDetail($id, $subscription, $document, $userCreator,
			$userModifier, $dateCreated, $dateModified, $active, $delete);
	}

	/**
	 * @param int    $id
	 * @param string $token
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 *
	 * @return PasswordToken
	 */
	static function createPasswordToken(int $id, string $token,
		int $userCreator = Values::DEFAULT_FOREIGN,
		int $userModifier = Values::DEFAULT_FOREIGN, string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE, bool $active = Values::DEFAULT_ACTIVE,
		bool $delete = Values::DEFAULT_DELETE)
	{
		return new PasswordToken($id,$token,$userCreator, $userModifier,
			$dateCreated, $dateModified, $active, $delete);
	}
}