<?php
/**
 * Generated by Houston
 * Date: 19-Nov-19
 * Time: 12:29 PM
 */
class FactoryDto {
	/**
	 * @param int    $id
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 * @param string $name
	 *
	 * @return DtoPropertyType
	 */
	static function createDtoPropertyType (int $id, int $userCreator = 0, int $userModifier = 0,
		string $dateCreated = "", string $dateModified = "", bool $active = false, bool $delete = false,
		string $name = ""):DtoPropertyType {
		return new DtoPropertyType($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete,
			$name);
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
	 * @param float  $price
	 *
	 * @return DtoPlan
	 */
	static function createDtoPlan (int $id, int $userCreator = 0, int $userModifier = 0, string $dateCreated = "",
		string $dateModified = "", bool $active = true, bool $delete = false, string $name = "",
		float $price = 0.0):DtoPlan {
		return new DtoPlan($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete, $name,
			$price);
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
	 * @param null   $seats
	 *
	 * @return DtoAgency
	 */
	static function createDtoAgency (int $id, int $userCreator = 0, int $userModifier = 0, string $dateCreated = "",
		string $dateModified = "", bool $active = true, bool $delete = false, string $name = "",
		$seats = null):DtoAgency {
		return new DtoAgency($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete, $name,
			$seats);
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
	 * @return DtoExtra
	 */
	static function createDtoExtra (int $id, string $name = Values::DEFAULT_STRING,
		string $icon = Values::DEFAULT_STRING,
		int $userCreator = Values::DEFAULT_FOREIGN, int $userModifier = Values::DEFAULT_FOREIGN,
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
	 * @param int    $id
	 * @param string $userCreator
	 * @param string $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 * @param string $name
	 * @param string $rif
	 *
	 * @return DtoSeat
	 */
	static function createDtoSeat (int $id, string $userCreator = "", string $userModifier = "",
		string $dateCreated = "", string $dateModified = "", bool $active = true, bool $delete = false,
		string $name = "", string $rif = ""):DtoSeat {
		return new DtoSeat($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete, $name,
			$rif);
	}

	/**
	 * @param int    $id
	 * @param string $date
	 * @param bool   $active
	 *
	 * @return DtoRequest
	 */
	static function createDtoRequest (int $id, $date = "", $active = true):DtoRequest {
		return new DtoRequest($id, $date, $active);
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
	 * @param array|DtoExtra[]         $extras
	 * @param array|DtoRequest[]       $request
	 * @param array|DtoPropertyPrice[] $propertyPrice
	 *
	 * @return DtoProperty
	 */
	static function createDtoProperty (int $id, $userCreator = "", $userModifier = "", $dateCreated = "",
		$dateModified = "", $active = 0, $delete = 0, $name = "", $area = 0.0, $description = "",
		$state = 0, $floor = 0, $type = 0, $location = 0, $extras = [], $request = [],
		$propertyPrice = []):DtoProperty {
		return new DtoProperty($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete, $name,
			$area, $description, $state, $floor, $type, $location, $extras, $request, $propertyPrice);
	}

	/**
	 * @param int    $id
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 * @param bool   $active
	 * @param bool   $delete
	 * @param float  $price
	 * @param bool   $final
	 * @param int    $propertyId
	 *
	 * @return DtoPropertyPrice
	 */
	static function createDtoPropertyPrice (int $id, int $userCreator, int $userModifier, string $dateCreated,
		string $dateModified, bool $active, bool $delete, float $price, bool $final,
		int $propertyId):DtoPropertyPrice {
		return new DtoPropertyPrice($id, $userCreator, $userModifier, $dateCreated, $dateModified, $active, $delete,
			$price, $final, $propertyId);
	}

	/**
	 * @param int    $id
	 * @param float  $score
	 * @param string $message
	 * @param bool   $active
	 *
	 * @return DtoRating
	 */
	static function createDtoRating (int $id, $score = 0.0, $message = "", $active = true):DtoRating {
		return new DtoRating($id, $score, $message, $active);
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
	static function createDtoAccess (int $id, int $userCreator = 0, int $userModifier = 0, string $dateCreated = "",
		string $dateModified = "", bool $active = false, bool $delete = false, string $name = "",
		string $abbreviation = ""):DtoAccess {
		return new DtoAccess($id, $userCreator, $userModifier, $dateCreated,
			$dateModified, $active, $delete, $name, $abbreviation);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param bool   $active
	 * @param bool   $delete
	 * @param        $userCreator
	 * @param        $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return DtoRol
	 */
	static function createDtoRol (int $id, string $name, bool $active, bool $delete, $userCreator, $userModifier,
		string $dateCreated = "", string $dateModified = ""):DtoRol {
		return new DtoRol($id, $name, $active, $delete, $userCreator, $userModifier, $dateCreated, $dateModified);
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
	 * @return DtoUser
	 */
	static function createDtoUser (int $id, string $firstName, string $lastName, string $address, string $email,
		string $password, int $userCreator, int $userModifier, bool $active, bool $blocked, bool $deleted, int $seat,
		int $rol, int $plan, int $location, string $dateCreated, string $dateModified):DtoUser {
		return new DtoUser($id, $firstName, $lastName, $address, $email, $password, $userCreator, $userModifier,
			$active, $blocked, $deleted, $seat, $rol, $plan, $location, $dateCreated, $dateModified);
	}

	/**
	 * @param int    $id
	 * @param int    $value
	 * @param int    $propertyId
	 * @param int    $extraId
	 * @param bool   $active
	 * @param bool   $delete
	 * @param int    $userCreator
	 * @param int    $userModifier
	 * @param string $dateCreated
	 * @param string $dateModified
	 *
	 * @return DtoPropertyExtra
	 */
	static function createDtoPropertyExtra (int $id, int $value, int $propertyId, int $extraId, bool $active,
		bool $delete,
		int $userCreator, int $userModifier, string $dateCreated, string $dateModified):DtoPropertyExtra {
		return new DtoPropertyExtra($id, $value, $propertyId, $extraId, $active, $delete, $userCreator, $userModifier,
			$dateCreated, $dateModified);
	}
}