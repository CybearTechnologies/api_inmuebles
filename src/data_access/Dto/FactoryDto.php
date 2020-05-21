<?php
/**
 * Generated by Houston
 * Date: 19-Nov-19
 * Time: 12:29 PM
 */
class FactoryDto {
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
	 * @return DtoPropertyType
	 */
	static function createDtoPropertyType (int $id, string $name = Values::DEFAULT_STRING,
		string $image = Values::DEFAULT_STRING, int $userCreator = Values::DEFAULT_FOREIGN,
		int $userModifier = Values::DEFAULT_FOREIGN, string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE, bool $active = Values::DEFAULT_ACTIVE,
		bool $delete = Values::DEFAULT_DELETE):DtoPropertyType {
		return new DtoPropertyType($id, $name, $image, $userCreator, $userModifier, $dateCreated, $dateModified,
			$active, $delete);
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
	 * @return DtoPropertyPrice
	 */
	static function createDtoPropertyPrice (int $id, float $price = Values::DEFAULT_FLOAT,
		bool $final = false, int $property = Values::DEFAULT_FOREIGN, int $userCreator = Values::DEFAULT_FOREIGN,
		int $userModifier = Values::DEFAULT_FOREIGN, string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE, $active = Values::DEFAULT_ACTIVE,
		$delete = Values::DEFAULT_DELETE):DtoPropertyPrice {
		return new DtoPropertyPrice($id, $price, $final, $property, $userCreator, $userModifier, $dateCreated,
			$dateModified, $active, $delete);
	}

	/**
	 * @param int         $id
	 * @param string      $name
	 * @param float       $price
	 * @param DtoUser|int $userCreator
	 * @param DtoUser|int $userModifier
	 * @param string      $dateCreated
	 * @param string      $dateModified
	 * @param bool        $active
	 * @param bool        $delete
	 *
	 * @return DtoPlan
	 */
	static function createDtoPlan (int $id, string $name = Values::DEFAULT_STRING, float $price = Values::DEFAULT_FLOAT,
		$userCreator = Values::DEFAULT_FOREIGN, $userModifier = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):DtoPlan {
		return new DtoPlan($id, $name, $price, $userCreator, $userModifier, $dateCreated, $dateModified, $active,
			$delete);
	}

	/**
	 * @param int            $id
	 * @param string         $name
	 * @param string         $icon
	 * @param DtoSeat[]|null $seats
	 * @param DtoUser|int    $userCreator
	 * @param DtoUser|int    $userModifier
	 * @param string         $dateCreated
	 * @param string         $dateModified
	 * @param bool           $active
	 * @param bool           $delete
	 *
	 * @return DtoAgency
	 */
	static function createDtoAgency (int $id, string $name = Values::DEFAULT_STRING,
		string $icon = Values::DEFAULT_STRING, $seats = Values::DEFAULT_ARRAY,
		$userCreator = Values::DEFAULT_INT, $userModifier = Values::DEFAULT_INT, //todo null user creator..
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):DtoAgency {
		return new DtoAgency($id, $name, $icon, $seats, $userCreator, $userModifier, $dateCreated, $dateModified,
			$active,
			$delete);
	}

	/**
	 * @param int         $id
	 * @param string      $name
	 * @param string      $icon
	 * @param DtoUser|int $userCreator
	 * @param DtoUser|int $userModifier
	 * @param string      $dateCreated
	 * @param string      $dateModified
	 * @param bool        $active
	 * @param bool        $delete
	 *
	 * @return DtoExtra
	 */
	static function createDtoExtra (int $id, string $name = Values::DEFAULT_STRING,
		string $icon = Values::DEFAULT_STRING,
		$userCreator = Values::DEFAULT_FOREIGN, $userModifier = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):DtoExtra {
		return new DtoExtra($id, $name, $icon, $userCreator, $userModifier, $dateCreated, $dateModified, $active,
			$delete);
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
	 * @return DtoLocation
	 */
	static function createDtoLocation (int $id, string $name = Values::DEFAULT_STRING,
		string $type = Values::DEFAULT_STRING, int $userCreator = Values::DEFAULT_FOREIGN,
		int $userModifier = Values::DEFAULT_FOREIGN, string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE, bool $active = Values::DEFAULT_ACTIVE,
		bool $delete = Values::DEFAULT_DELETE):DtoLocation {
		return new DtoLocation($id, $name, $type, $userCreator, $userModifier, $dateCreated, $dateModified, $active,
			$delete);
	}

	/**
	 * @param int             $id
	 * @param string          $name
	 * @param string          $rif
	 * @param DtoLocation|int $location
	 * @param DtoAgency|int   $agency
	 * @param DtoUser|int     $userCreator
	 * @param DtoUser|int     $userModifier
	 * @param string          $dateCreated
	 * @param string          $dateModified
	 * @param bool            $active
	 * @param bool            $delete
	 *
	 * @return DtoSeat
	 */
	static function createDtoSeat (int $id, string $name = Values::DEFAULT_STRING, string $rif = Values::DEFAULT_STRING,
		$location = Values::DEFAULT_INT, $agency = Values::DEFAULT_INT,
		$userCreator = Values::DEFAULT_FOREIGN, $userModifier = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):DtoSeat {
		return new DtoSeat($id, $name, $rif, $location, $agency, $userCreator, $userModifier, $dateCreated,
			$dateModified, $active, $delete);
	}

	/**
	 * @param int         $id
	 * @param int         $property
	 * @param DtoUser|int $userCreator
	 * @param DtoUser|int $userModifier
	 * @param string      $dateCreated
	 * @param string      $dateModified
	 * @param bool        $active
	 * @param bool        $delete
	 *
	 * @return DtoRequest
	 */
	static function createDtoRequest (int $id, int $property = Values::DEFAULT_FOREIGN,
		$userCreator = Values::DEFAULT_FOREIGN, $userModifier = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):DtoRequest {
		return new DtoRequest($id, $property, $userCreator, $userModifier, $dateCreated, $dateModified, $active,
			$delete);
	}

	/**
	 * @param int                $id
	 * @param string             $name
	 * @param int                $area
	 * @param string             $description
	 * @param string             $publishDate
	 * @param int                $state
	 * @param int                $floor
	 * @param DtoExtra[]         $extras
	 * @param DtoRequest[]       $request
	 * @param DtoUser|null       $user
	 * @param DtoPropertyPrice[] $propertyPrice
	 *
	 * @return DtoProperty
	 */
	//int $id,int $userCreator,int $userModifier,int $dateCreated,int $dateModified,bool $active, bool $delete, string $name, float $area, string $description,
	//		int $state, int $floor, $extras, $request, $user, $price
	/**
	 * @param int                      $id
	 * @param int                      $favorite
	 * @param string                   $userCreator
	 * @param string                   $userModifier
	 * @param string                   $dateCreated
	 * @param string                   $dateModified
	 * @param int                      $active
	 * @param int                      $delete
	 * @param string                   $name
	 * @param float                    $area
	 * @param string                   $description
	 * @param int                      $state
	 * @param int                      $floor
	 * @param int                      $type
	 * @param int                      $location
	 * @param array|DtoPropertyExtra[] $extras
	 * @param array|DtoRequest[]       $request
	 * @param array|DtoPropertyPrice[] $propertyPrice
	 *
	 * @return DtoProperty
	 */
	static function createDtoProperty (int $id, int $favorite=0,$userCreator = "", $userModifier = "", $dateCreated = "",
		$dateModified = "", $active = 0, $delete = 0, $name = "", $area = 0.0, $description = "",
		$state = 0, $floor = 0, $type = 0, $location = 0, $extras = [], $request = [],
		$propertyPrice = []):DtoProperty {
		return new DtoProperty($id, $favorite,$userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete, $name,
			$area, $description, $state, $floor, $type, $location, $extras, $request, $propertyPrice);
	}

	/**
	 * @param int         $id
	 * @param float       $score
	 * @param string      $message
	 * @param int         $target
	 * @param DtoUser|int $userCreator
	 * @param DtoUser|int $userModifier
	 * @param string      $dateCreated
	 * @param string      $dateModified
	 * @param bool        $active
	 * @param bool        $delete
	 *
	 * @return DtoRating
	 */
	static function createDtoRating (int $id, $score = Values::DEFAULT_FLOAT, $message = Values::DEFAULT_STRING,
		int $target = Values::DEFAULT_FOREIGN,
		$userCreator = Values::DEFAULT_FOREIGN,
		$userModifier = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE, bool $active = Values::DEFAULT_ACTIVE,
		bool $delete = Values::DEFAULT_DELETE):DtoRating {
		return new DtoRating($id, $score, $message, $target, $userCreator, $userModifier, $dateCreated, $dateModified,
			$active, $delete);
	}

	/**
	 * @param int    $id
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 * @param string $name
	 * @param string $abbreviation
	 *
	 * @return DtoAccess
	 */
	static function createDtoAccess (int $id, string $name = Values::DEFAULT_STRING,
		string $abbreviation = Values::DEFAULT_STRING, int $userCreator = Values::DEFAULT_FOREIGN,
		int $userModifier = Values::DEFAULT_FOREIGN, string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):DtoAccess {
		return new DtoAccess($id, $name, $abbreviation, $userCreator, $userModifier, $dateCreated, $dateModified,
			$active, $delete);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param array  $access
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 *
	 * @return DtoRol
	 */
	static function createDtoRol (int $id, string $name = Values::DEFAULT_STRING, $access = Values::DEFAULT_ARRAY,
		int $userCreator = Values::DEFAULT_FOREIGN, int $userModifier = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):DtoRol {
		return new DtoRol($id, $name, $access, $userCreator, $userModifier, $dateCreated, $dateModified, $active,
			$delete);
	}

	/**
	 * @param int             $id
	 * @param string          $firstName
	 * @param string          $lastName
	 * @param string          $address
	 * @param string          $email
	 * @param string          $password
	 * @param int             $identity
	 * @param string          $passport
	 * @param array           $documents
	 * @param DtoUser|int     $userCreator
	 * @param DtoUser|int     $userModifier
	 * @param bool            $active
	 * @param bool            $blocked
	 * @param bool            $deleted
	 * @param DtoSeat|int     $seat
	 * @param DtoRol|int      $rol
	 * @param DtoPlan|int     $plan
	 * @param DtoLocation|int $location
	 * @param string          $dateCreated
	 * @param string          $dateModified
	 *
	 * @return DtoUser
	 */
	static function createDtoUser (int $id, string $firstName = Values::DEFAULT_STRING,
		string $lastName = Values::DEFAULT_STRING, string $address = Values::DEFAULT_STRING,
		string $email = Values::DEFAULT_STRING, string $password = Values::DEFAULT_STRING,
		int $identity = Values::DEFAULT_INT, string $passport = Values::DEFAULT_STRING,
		$documents = Values::DEFAULT_ARRAY, $userCreator = Values::DEFAULT_FOREIGN,
		$userModifier = Values::DEFAULT_FOREIGN, bool $active = Values::DEFAULT_ACTIVE,
		bool $blocked = Values::DEFAULT_STATUS,
		bool $deleted = Values::DEFAULT_DELETE, $seat = Values::DEFAULT_FOREIGN, $rol = Values::DEFAULT_FOREIGN,
		$plan = Values::DEFAULT_FOREIGN, $location = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE):DtoUser {
		return new DtoUser($id, $firstName, $lastName, $address, $email, $password, $identity, $passport, $documents,
			$userCreator,$userModifier, $active, $blocked, $deleted, $seat, $rol, $plan,
			$location, $dateCreated, $dateModified);
	}

	/**
	 * @param int    $id
	 * @param int    $value
	 * @param int    $property
	 * @param int    $extra
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return DtoPropertyExtra
	 */
	static function createDtoPropertyExtra (int $id, $value = Values::DEFAULT_INT, $property = Values::DEFAULT_FOREIGN,
		$extra = Values::DEFAULT_FOREIGN, bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE,
		int $userCreator = Values::DEFAULT_INT, int $userModifier = Values::DEFAULT_INT,
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE):DtoPropertyExtra {
		return new DtoPropertyExtra($id, $value, $property, $extra, $active, $delete, $userCreator,
			$userModifier, $dateCreated, $dateModified);
	}

	/**
	 * @param int           $id
	 * @param DtoRol|int    $rol
	 * @param DtoAccess|int $access
	 * @param DtoUser|int   $userCreator
	 * @param DtoUser|int   $userModifier
	 * @param string        $dateCreated
	 * @param string        $dateModified
	 * @param bool          $active
	 * @param bool          $delete
	 *
	 * @return DtoRolAccess
	 */
	static function createDtoRolAccess (int $id, $rol = Values::DEFAULT_FOREIGN,
		$access = Values::DEFAULT_FOREIGN,
		int $userCreator = Values::DEFAULT_FOREIGN,
		int $userModifier = Values::DEFAULT_FOREIGN, string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE, bool $active = Values::DEFAULT_ACTIVE,
		bool $delete = Values::DEFAULT_DELETE):DtoRolAccess {
		return new DtoRolAccess($id, $rol, $access, $userCreator, $userModifier, $dateCreated,
			$dateModified,
			$active, $delete);
	}

	/**
	 * @param int         $id
	 * @param int         $property
	 * @param DtoUser|int $userCreator
	 * @param DtoUser|int $userModifier
	 * @param string      $dateCreated
	 * @param string      $dateModified
	 * @param bool        $active
	 * @param bool        $delete
	 *
	 * @return DtoFavorite
	 */
	static function createDtoFavorite (int $id, $property = Values::DEFAULT_FOREIGN,
		$userCreator = Values::DEFAULT_FOREIGN, $userModifier = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE, $dateModified = Values::DEFAULT_DATE,
		$active = Values::DEFAULT_ACTIVE, $delete = Values::DEFAULT_DELETE) {
		return new DtoFavorite($id, $property, $userCreator, $userModifier, $dateCreated,
			$dateModified, $active, $delete);
	}

	/**
	 * @param int                           $id
	 * @param string                        $firstName
	 * @param string                        $lastName
	 * @param string                        $address
	 * @param DtoPlan|int                   $plan
	 * @param DtoSeat|int                   $seat
	 * @param DtoLocation|int               $location
	 * @param int                           $ci
	 * @param string                        $passport
	 * @param string                        $email
	 * @param string                        $password
	 * @param array|DtoSubscriptionDetail[] $subsDetails
	 * @param int                           $userCreator
	 * @param int                           $userModifier
	 * @param string                        $dateCreated
	 * @param string                        $dateModified
	 * @param bool                          $active
	 * @param bool                          $delete
	 * @param bool                          $status
	 *
	 * @return DtoSubscription
	 */
	static function createDtoSubscription (int $id, string $firstName, string $lastName,
		string $address, $plan, $seat, $location, int $ci, string $passport,
		string $email, string $password, $subsDetails, int $userCreator = Values::DEFAULT_FOREIGN,
		int $userModifier = Values::DEFAULT_FOREIGN, string $dateCreated = Values::DEFAULT_DATE,
		string $dateModified = Values::DEFAULT_DATE, bool $active = Values::DEFAULT_ACTIVE,
		bool $delete = Values::DEFAULT_DELETE, bool $status = Values::DEFAULT_STATUS):DtoSubscription {
		return new DtoSubscription($id, $firstName, $lastName, $address, $plan, $seat, $location, $ci,
			$passport, $email, $password,
			$subsDetails, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete,
			$status);
	}

	/**
	 * @param int                 $id
	 * @param string              $document
	 * @param DtoSubscription|int $subscription
	 * @param int                 $userCreator
	 * @param int                 $userModifier
	 * @param string              $dateCreated
	 * @param string              $dateModified
	 * @param bool                $active
	 * @param bool                $delete
	 *
	 * @return DtoSubscriptionDetail
	 */
	static function createDtoSubscriptionDetail (int $id, string $document, $subscription,
		int $userCreator = Values::DEFAULT_FOREIGN, int $userModifier = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):DtoSubscriptionDetail {
		return new DtoSubscriptionDetail($id, $document, $subscription, $userCreator, $userModifier,
			$dateCreated, $dateModified, $active, $delete);
	}

	/**
	 * @param DtoUser $user
	 * @param string  $token
	 *
	 * @return DtoLogin
	 */
	static function createDtoLogin ($user, $token):DtoLogin {
		return new DtoLogin($user, $token);
	}

	/**
	 * @param int         $id
	 * @param string      $token
	 * @param DtoUser|int $userCreator
	 * @param DtoUser|int $userModifier
	 * @param string      $dateCreated
	 * @param string      $dateModified
	 * @param bool        $active
	 * @param bool        $delete
	 *
	 * @return DtoPasswordToken
	 */
	static function createDtoPasswordToken (int $id, string $token,
		$userCreator = Values::DEFAULT_FOREIGN, $userModifier = Values::DEFAULT_FOREIGN,
		string $dateCreated = Values::DEFAULT_DATE, string $dateModified = Values::DEFAULT_DATE,
		bool $active = Values::DEFAULT_ACTIVE, bool $delete = Values::DEFAULT_DELETE):DtoPasswordToken {
		return new DtoPasswordToken($id, $token, $userCreator, $userModifier, $dateCreated, $dateModified, $active,
			$delete);
	}
}