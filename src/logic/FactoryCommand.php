<?php
/**
 * Generated by Houston
 * Date: 19-Nov-19
 * Time: 12:29 PM
 */
class FactoryCommand {
	//------------------------------------------------------------
	//----------------------------RolAccess-----------------------
	//------------------------------------------------------------
	/**
	 * @param RolAccess $rolAccess
	 *
	 * @return CommandCreateRolAccess
	 */
	static function createCommandCreateRolAccess (RolAccess $rolAccess):CommandCreateRolAccess {
		return new CommandCreateRolAccess($rolAccess);
	}

	/**
	 * @param RolAccess $rolAccess
	 *
	 * @return CommandGetAccessByRol
	 */
	static function createCommandGetAccessByRol (RolAccess $rolAccess):CommandGetAccessByRol {
		return new CommandGetAccessByRol($rolAccess);
	}

	/**
	 * @param int $rol
	 * @param int $access
	 *
	 * @return CommandActivateRolAccessById
	 */
	static function createCommandActivateRolAccess (int $rol, int $access):CommandActivateRolAccessById {
		return new CommandActivateRolAccessById($rol, $access);
	}

	/**
	 * @param int $rol
	 * @param int $access
	 *
	 * @return CommandDeactivateRolAccessById
	 */
	static function createCommandDeactivateRolAccess ($rol, $access):CommandDeactivateRolAccessById {
		return new CommandDeactivateRolAccessById($rol, $access);
	}
	//------------------------------------------------------------
	//----------------------------USER----------------------------
	//------------------------------------------------------------
	/**
	 * @param int $user
	 *
	 * @return CommandGetUserById
	 */
	public static function createCommandGetUserById ($user):CommandGetUserById {
		return new CommandGetUserById($user);
	}

	/**
	 * @param string $user
	 *
	 * @return CommandGetUserByUsername
	 */
	public static function createCommandGetUserByUsername (string $user) {
		return new CommandGetUserByUsername($user);
	}

	/**
	 * @return CommandGetAllUser
	 */
	static function createCommandGetAllUser ():CommandGetAllUser {
		return new CommandGetAllUser();
	}

	/**
	 * @param $user
	 *
	 * @return CommandActivateUser
	 */
	static function createCommandActivateUser ($user):CommandActivateUser {
		return new CommandActivateUser($user);
	}

	/**
	 * @param $user
	 *
	 * @return CommandInactiveUser
	 */
	static function createCommandInactiveUser ($user):CommandInactiveUser {
		return new CommandInactiveUser($user);
	}

	/**
	 * @param $user
	 *
	 * @return CommandDeleteUser
	 */
	static function createCommandDeleteUser ($user):CommandDeleteUser {
		return new CommandDeleteUser($user);
	}

	/**
	 * @param $id
	 * @param $userModifier
	 *
	 * @return CommandBlockUser
	 */
	static function createCommandBlockUser ($id, $userModifier):CommandBlockUser {
		return new CommandBlockUser($id, $userModifier);
	}

	/**
	 * @param $user
	 *
	 * @return CommandUnblockUser
	 */
	static function createCommandUnblockUser ($user):CommandUnblockUser {
		return new CommandUnblockUser($user);
	}

	/**
	 * @param      $id
	 * @param      $firstName
	 * @param      $lastName
	 * @param      $address
	 * @param      $email
	 * @param      $phone
	 * @param      $seat
	 * @param      $agency
	 * @param      $plan
	 * @param      $location
	 * @param      $userModifier
	 * @param      $dateModified
	 *
	 * @return CommandUpdateUser
	 */
	static function createCommandUpdateUser ($id, $firstName, $lastName, $address, $email, $phone,$seat, $agency,$plan, $location,
		$userModifier, $dateModified = null):CommandUpdateUser {
		return new CommandUpdateUser($id, $firstName, $lastName, $address, $email, $phone,$seat, $agency,$plan, $location,
			$userModifier, $dateModified);
	}

	/**
	 * @param $_id
	 * @param $_firstName
	 * @param $_lastName
	 * @param $_address
	 * @param $_email
	 * @param $_phone
	 * @param $modifier
	 *
	 * @return CommandUpdateUserProfile
	 */
	static function createCommandUpdateUserProfile ($_id, $_firstName, $_lastName, $_address, $_email,$_phone,
		$modifier):CommandUpdateUserProfile {
		return new CommandUpdateUserProfile($_id, $_firstName, $_lastName, $_address, $_email, $_phone,$modifier);
	}

	/**
	 * @param $user
	 *
	 * @return CommandSetUserPlan
	 */
	static function createCommandSetUserPlan ($user, $plan):CommandSetUserPlan {
		return new CommandSetUserPlan($user, $plan);
	}

	/**
	 * @param $user
	 * @param $password
	 *
	 * @return CommandChangePassword
	 */
	static function createCommandChangeUserPassword ($user, $password):CommandChangePassword {
		return new CommandChangePassword($user, $password);
	}
	//------------------------------------------------------------
	//----------------------------ROL----------------------------
	//------------------------------------------------------------
	/**
	 * @param $name
	 * @param $access
	 * @param $user
	 *
	 * @return CommandCreateRol
	 */
	static function createCommandCreateRol ($name, $access, $user):CommandCreateRol {
		return new CommandCreateRol($name, $access, $user);
	}

	/**
	 * @return CommandGetAllRoles
	 */
	static function createCommandGetAllRoles ():CommandGetAllRoles {
		return new CommandGetAllRoles();
	}

	/**
	 * @param $rol
	 *
	 * @return CommandGetRolById
	 */
	static function createCommandGetRolById ($rol):CommandGetRolById {
		return new CommandGetRolById($rol);
	}

	/**
	 * @param $rol
	 *
	 * @return CommandDeleteRol
	 */
	static function createCommandDeleteRol ($rol):CommandDeleteRol {
		return new CommandDeleteRol($rol);
	}

	/**
	 * @param $rol
	 *
	 * @return CommandUpdateRolById
	 */
	static function createCommandUpdateRol ($rol):CommandUpdateRolById {
		return new CommandUpdateRolById($rol);
	}

	/**
	 * @param $rol
	 *
	 * @return CommandInactiveRolById
	 */
	static function createCommandInactiveRol ($rol):CommandInactiveRolById {
		return new CommandInactiveRolById($rol);
	}

	/**
	 * @param $rol
	 *
	 * @return CommandActiveRolById
	 */
	static function createCommandActivateRol ($rol):CommandActiveRolById {
		return new CommandActiveRolById($rol);
	}
	//------------------------------------------------------------
	//----------------------------REQUEST-------------------------
	//------------------------------------------------------------
	/**
	 * @param int $property
	 * @param int $user
	 *
	 * @return CommandCreateRequest
	 */
	static function createCommandCreateRequest (int $property, int $user):CommandCreateRequest {
		return new CommandCreateRequest($property, $user);
	}

	/**
	 * @return CommandGetAllRequest
	 */
	static function createCommandGetAllRequest ():CommandGetAllRequest {
		return new CommandGetAllRequest();
	}

	/**
	 * @param $user
	 *
	 * @return CommandGetAllPendingRequest
	 */
	static function createCommandGetAllPendingRequest ($user):CommandGetAllPendingRequest {
		return new CommandGetAllPendingRequest($user);
	}

	/**
	 * @param int $id
	 *
	 * @return CommandGetRequestById
	 */
	static function createCommandGetRequestById ($id):CommandGetRequestById {
		return new CommandGetRequestById($id);
	}

	/**
	 * @param int $property
	 *
	 * @return CommandGetAllRequestByPropertyId
	 */
	static function createCommandGetAllRequestByPropertyId ($property):CommandGetAllRequestByPropertyId {
		return new CommandGetAllRequestByPropertyId($property);
	}

	/**
	 * @param $id
	 * @param $user
	 *
	 * @return CommandDeleteRequestById
	 */
	static function createCommandDeleteRequestById (int $id, int $user):CommandDeleteRequestById {
		return new CommandDeleteRequestById($id, $user);
	}

	/**
	 * @param int $user
	 *
	 * @return CommandGetAllRequestByUserId
	 */
	static function createCommandGetAllRequestByUserId ($user):CommandGetAllRequestByUserId {
		return new CommandGetAllRequestByUserId($user);
	}

	//------------------------------------------------------------
	//----------------------------LOCATION------------------------
	//------------------------------------------------------------
	/**
	 * @param Location $location
	 *
	 * @return CommandGetLocationById
	 */
	static function createCommandGetLocationById ($location):CommandGetLocationById {
		return new CommandGetLocationById($location);
	}

	/**
	 * @param Location $location
	 *
	 * @return CommandGetLocationsByType
	 */
	static function createCommandGetLocationsByType ($location):CommandGetLocationsByType {
		return new CommandGetLocationsByType($location);
	}

	/**
	 * @param $state
	 *
	 * @return CommandGetAllTownByState
	 */
	static function createCommandGetAllTownByState ($state):CommandGetAllTownByState {
		return new CommandGetAllTownByState($state);
	}
	//------------------------------------------------------------
	//----------------------------ACCESS--------------------------
	//------------------------------------------------------------
	/**
	 * @param string $name
	 * @param string $abbreviation
	 * @param int    $loggedUser
	 *
	 * @return CommandCreateAccess
	 */
	static function createCommandCreateAccess ($name, $abbreviation, $loggedUser):CommandCreateAccess {
		return new CommandCreateAccess($name, $abbreviation, $loggedUser);
	}

	/**
	 * @return CommandGetAllAccess
	 */
	static function createCommandGetAllAccess ():CommandGetAllAccess {
		return new CommandGetAllAccess();
	}

	/**
	 * @param int $id
	 *
	 * @return CommandGetAccessById
	 */
	static function createCommandGetAccessById ($id):CommandGetAccessById {
		return new CommandGetAccessById($id);
	}

	/**
	 * @param Access $access
	 *
	 * @return CommandGetAccessByAbbreviation
	 */
	static function createCommandGetAccessByAbbreviation ($access):CommandGetAccessByAbbreviation {
		return new CommandGetAccessByAbbreviation($access);
	}

	/**
	 * @param Access $access
	 *
	 * @return CommandGetAccessByName
	 */
	static function createCommandGetAccessByName ($access):CommandGetAccessByName {
		return new CommandGetAccessByName($access);
	}

	/**
	 * @param int $id
	 * @param int $user
	 *
	 * @return CommandDeleteAccessById
	 */
	static function createCommandDeleteAccessById (int $id, int $user):CommandDeleteAccessById {
		return new CommandDeleteAccessById($id, $user);
	}
	//------------------------------------------------------------
	//----------------------------SEAT---------------------------
	//------------------------------------------------------------
	/**
	 * @param string $name
	 * @param string $rif
	 * @param string $location
	 * @param string $agency
	 * @param int    $user
	 *
	 * @return CommandCreateSeat
	 */
	static function createCommandCreateSeat ($name, $rif, $location, $agency, $user):CommandCreateSeat {
		return new CommandCreateSeat($name, $rif, $location, $agency, $user);
	}

	/**
	 * @return CommandGetAllSeats
	 */
	static function createCommandGetAllSeats ():CommandGetAllSeats {
		return new CommandGetAllSeats();
	}

	/**
	 * @param int $seat
	 *
	 * @return CommandGetSeatById
	 */
	static function createCommandGetSeatById ($seat):CommandGetSeatById {
		return new CommandGetSeatById($seat);
	}

	/**
	 * @param int $agency
	 *
	 * @return CommandGetAllSeatsByAgency
	 */
	static function createCommandGetAllSeatsByAgency ($agency):CommandGetAllSeatsByAgency {
		return new CommandGetAllSeatsByAgency($agency);
	}

	/**
	 * @param $seat
	 *
	 * @return CommandGetSeatByName
	 */
	static function createCommandGetSeatByName ($seat):CommandGetSeatByName {
		return new CommandGetSeatByName($seat);
	}

	/**
	 * @param Seat $seat
	 *
	 * @return CommandUpdateSeat
	 */
	static function createCommandUpdateSeatById ($seat):CommandUpdateSeat {
		return new CommandUpdateSeat($seat);
	}

	/**
	 * @param Seat $seat
	 *
	 * @return CommandActiveSeat
	 */
	static function createCommandActiveSeatById ($seat):CommandActiveSeat {
		return new CommandActiveSeat($seat);
	}

	/**
	 * @param Seat $seat
	 *
	 * @return CommandInactiveSeat
	 */
	static function createCommandInactiveSeatById ($seat):CommandInactiveSeat {
		return new CommandInactiveSeat($seat);
	}

	/**
	 * @param $seat
	 *
	 * @return CommandDeleteSeatById
	 */
	static function createCommandDeleteSeatById ($seat):CommandDeleteSeatById {
		return new CommandDeleteSeatById($seat);
	}
	//------------------------------------------------------------
	//----------------------------AGENCY---------------------------
	//------------------------------------------------------------
	/**
	 * @param Agency $agency
	 *
	 * @return CommandCreateAgency
	 */
	static function createCommandCreateAgency ($agency):CommandCreateAgency {
		return new CommandCreateAgency($agency);
	}

	/**
	 * @return CommandGetAllAgencies
	 */
	static function createCommandGetAllAgencies ():CommandGetAllAgencies {
		return new CommandGetAllAgencies();
	}

	/**
	 * @param int $agency
	 *
	 * @return CommandGetAgencyById
	 */
	static function createCommandGetAgencyById ($agency):CommandGetAgencyById {
		return new CommandGetAgencyById($agency);
	}

	/**
	 * @param Agency $agency
	 *
	 * @return CommandGetAgencyByName
	 */
	public static function createCommandGetAgencyByName ($agency):CommandGetAgencyByName {
		return new CommandGetAgencyByName($agency);
	}

	/**
	 * @param Agency $agency
	 *
	 * @return CommandDeleteAgencyById
	 */
	static function createCommandDeleteAgencyById ($agency):CommandDeleteAgencyById {
		return new CommandDeleteAgencyById($agency);
	}

	/**
	 * @param $agency
	 *
	 * @return CommandUpdateAgency
	 */
	static function createCommandUpdateAgencyById ($agency):CommandUpdateAgency {
		return new CommandUpdateAgency($agency);
	}

	/**
	 * @param $agency
	 *
	 * @return CommandActiveAgency
	 */
	static function createCommandActiveAgencyById ($agency):CommandActiveAgency {
		return new CommandActiveAgency($agency);
	}

	/**
	 * @param $agency
	 *
	 * @return CommandInactiveAgency
	 */
	static function createCommandInactiveAgencyById ($agency):CommandInactiveAgency {
		return new CommandInactiveAgency($agency);
	}
	//------------------------------------------------------------
	//----------------------------PLAN----------------------------
	//------------------------------------------------------------
	/**
	 * @param Plan $plan
	 *
	 * @return CommandCreatePlan
	 */
	static function createCommandCreatePlan ($plan):CommandCreatePlan {
		return new CommandCreatePlan($plan);
	}

	/**
	 * @return CommandGetAllPlan
	 */
	static function createCommandGetAllPlan ():CommandGetAllPlan {
		return new CommandGetAllPlan();
	}

	/**
	 * @param Plan $plan
	 *
	 * @return CommandGetPlanById
	 */
	static function createCommandGetPlanById ($plan):CommandGetPlanById {
		return new CommandGetPlanById($plan);
	}

	/**
	 * @param Plan $plan
	 *
	 * @return CommandGetPlanByName
	 */
	static function createCommandGetPlanByName ($plan):CommandGetPlanByName {
		return new CommandGetPlanByName($plan);
	}

	/**
	 * @param Plan $plan
	 *
	 * @return CommandUpdatePlan
	 */
	static function createCommandUpdatePlan ($plan):CommandUpdatePlan {
		return new CommandUpdatePlan($plan);
	}

	/**
	 * @param Plan $plan
	 *
	 * @return CommandDeletePlanById
	 */
	static function createCommandDeletePlanById ($plan):CommandDeletePlanById {
		return new CommandDeletePlanById($plan);
	}

	/**
	 * @param $plan
	 *
	 * @return CommandUpdatePlan
	 */
	static function createCommandUpdatePlanById ($plan):CommandUpdatePlan {
		return new CommandUpdatePlan($plan);
	}

	/**
	 * @param $plan
	 *
	 * @return CommandActivePlan
	 */
	static function createCommandActivePlanById ($plan):CommandActivePlan {
		return new CommandActivePlan($plan);
	}

	/**
	 * @param $plan
	 *
	 * @return CommandInactivePlan
	 */
	static function createCommandInactivePlanById ($plan):CommandInactivePlan {
		return new CommandInactivePlan($plan);
	}

	//------------------------------------------------------------
	//-----------------------PROPERTY TYPE------------------------
	//------------------------------------------------------------
	/**
	 * @param PropertyType $propertyType
	 *
	 * @return CommandCreatePropertyType
	 */
	static function createCommandCreatePropertyType ($propertyType):CommandCreatePropertyType {
		return new CommandCreatePropertyType($propertyType);
	}

	/**
	 * @return CommandGetAllPropertyType
	 */
	static function createCommandGetAllPropertyType ():CommandGetAllPropertyType {
		return new CommandGetAllPropertyType();
	}

	/**
	 * @param int $id
	 *
	 * @return CommandGetPropertyTypeById
	 */
	static function createCommandGetPropertyTypeById ($id):CommandGetPropertyTypeById {
		return new CommandGetPropertyTypeById($id);
	}

	/**
	 * @param PropertyType $propertyType
	 *
	 * @return CommandGetPropertyTypeByName
	 */
	static function createCommandGetPropertyTypeByName ($propertyType):CommandGetPropertyTypeByName {
		return new CommandGetPropertyTypeByName($propertyType);
	}

	/**
	 * @param PropertyType $propertyType
	 *
	 * @return CommandDeletePropertyType
	 */
	static function createCommandDeletePropertyType ($propertyType):CommandDeletePropertyType {
		return new CommandDeletePropertyType($propertyType);
	}

	//------------------------------------------------------------
	//-----------------------PROPERTY PRICE-----------------------
	//------------------------------------------------------------
	/**
	 * @param     $price
	 * @param int $propertyId
	 * @param int $creator
	 *
	 * @return CommandCreatePropertyPrice
	 */
	static function createCommandCreatePropertyPrice ($price, int $propertyId,
		int $creator):CommandCreatePropertyPrice {
		return new CommandCreatePropertyPrice($price, $propertyId, $creator);
	}

	/**
	 * @param int $propertyPrice
	 *
	 * @return CommandGetPropertyPriceByPropertyId
	 */
	static function createCommandGetPropertyPriceByPropertyId ($propertyPrice):CommandGetPropertyPriceByPropertyId {
		return new CommandGetPropertyPriceByPropertyId($propertyPrice);
	}

	/**
	 * @param PropertyPrice $propertyPrice
	 *
	 * @return CommandGetPropertyPriceById
	 */
	static function createCommandGetPropertyPriceById ($propertyPrice):CommandGetPropertyPriceById {
		return new CommandGetPropertyPriceById($propertyPrice);
	}

	//------------------------------------------------------------
	//----------------------------EXTRA---------------------------
	//------------------------------------------------------------
	/**
	 * @param string $name
	 * @param string $image
	 * @param int    $user
	 *
	 * @return CommandCreateExtra
	 */
	static function createCommandCreateExtra ($name, $image, $user):CommandCreateExtra {
		return new CommandCreateExtra($name, $image, $user);
	}

	/**
	 * @return CommandGetAllExtra
	 */
	static function createCommandGetAllExtra ():CommandGetAllExtra {
		return new CommandGetAllExtra();
	}

	/**
	 * @param Extra $extra
	 *
	 * @return CommandGetAllExtraByState
	 */
	static function createCommandGetAllExtraByState ($extra):CommandGetAllExtraByState {
		return new CommandGetAllExtraByState($extra);
	}

	/**
	 * @param int $extra
	 *
	 * @return CommandGetExtraById
	 */
	static function createCommandGetExtraById ($extra):CommandGetExtraById {
		return new CommandGetExtraById($extra);
	}

	/**
	 * @param int $id
	 * @param int $user
	 *
	 * @return CommandDeleteExtraById
	 */
	static function createCommandDeleteExtraById (int $id, int $user):CommandDeleteExtraById {
		return new CommandDeleteExtraById($id, $user);
	}

	/**
	 * @param int $property
	 *
	 * @return GetAllExtrasByPropertyIdCommand
	 */
	static function createCommandGetAllExtrasByPropertyId ($property):GetAllExtrasByPropertyIdCommand {
		return new GetAllExtrasByPropertyIdCommand($property);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param string $icon
	 * @param int    $user
	 *
	 * @return CommandUpdateExtra
	 */
	static function createCommandUpdateExtraById (int $id, string $name, string $icon, int $user):CommandUpdateExtra {
		return new CommandUpdateExtra($id, $name, $icon, $user);
	}

	/**
	 * @param int $extra
	 * @param int $user
	 *
	 * @return CommandActiveExtra
	 */
	static function createCommandActiveExtraById ($extra, $user):CommandActiveExtra {
		return new CommandActiveExtra($extra, $user);
	}

	/**
	 * @param int $extra
	 * @param int $user
	 *
	 * @return CommandInactiveExtra
	 */
	static function createCommandInactiveExtraById (int $extra, int $user):CommandInactiveExtra {
		return new CommandInactiveExtra($extra, $user);
	}
	//------------------------------------------------------------
	//----------------------------PROPERTY-----------------------
	//------------------------------------------------------------
	/**
	 * @param int $loggedUser
	 *
	 * @return CommandListProperties
	 */
	static function createCommandListProperties (int $loggedUser):CommandListProperties {
		return new CommandListProperties($loggedUser);
	}


	/////////////////////////////VIEJOS PA ABAJO ////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////
	/**
	 * @param Property $property
	 *
	 * @return CommandCreateProperty
	 */
	static function createCommandCreateProperty ($property):CommandCreateProperty {
		return new CommandCreateProperty($property);
	}

	/**
	 * @param int $property
	 * @param int $user
	 *
	 * @return CommandActiveProperty
	 */
	static function createCommandActiveProperty ($property, $user):CommandActiveProperty {
		return new CommandActiveProperty($property, $user);
	}

	/**
	 * @param int $property
	 * @param int $user
	 *
	 * @return CommandInactiveProperty
	 */
	static function createCommandInactiveProperty ($property, $user):CommandInactiveProperty {
		return new CommandInactiveProperty($property, $user);
	}

	/**
	 * @param int $property
	 *
	 * @return CommandGetAllUserProperties
	 */
	static function createCommandGetAllUserProperties ($property):CommandGetAllUserProperties {
		return new CommandGetAllUserProperties($property);
	}

	/**
	 * @param Property $property
	 *
	 * @return CommandGetAllUserPropertiesByState
	 */
	static function createCommandGetAllUserPropertiesByState ($property):CommandGetAllUserPropertiesByState {
		return new CommandGetAllUserPropertiesByState($property);
	}

	/**
	 * @return CommandGetAllPropertiesByType
	 */
	static function createCommandGetAllPropertiesByType ():CommandGetAllPropertiesByType {
		return new CommandGetAllPropertiesByType();
	}

	/**
	 * @param      $id
	 * @param      $destiny
	 * @param      $name
	 * @param      $area
	 * @param      $description
	 * @param      $floor
	 * @param      $type
	 * @param      $location
	 * @param      $user
	 * @param      $dateModified
	 *
	 * @return CommandUpdateProperty
	 */
	static function createCommandUpdateProperty ($id, $destiny, $name, $area, $description, $floor, $type, $location,
		$user,
		$dateModified = null):CommandUpdateProperty {
		return new CommandUpdateProperty($id, $destiny, $name, $area, $description, $floor, $type, $location, $user,
			$dateModified);
	}

	/**
	 * @param Property $property
	 *
	 * @return CommandDeletePropertyById
	 */
	static function createCommandDeletePropertyById ($property):CommandDeletePropertyById {
		return new CommandDeletePropertyById($property);
	}

	/**
	 * @param $loggedUser
	 *
	 * @return CommandGetAllPropertyAdmin
	 */
	static function createCommandGetAllPropertyAdmin ($loggedUser):CommandGetAllPropertyAdmin {
		return new CommandGetAllPropertyAdmin($loggedUser);
	}

	/**
	 * @param int $property
	 * @param     $loggedUser
	 *
	 * @return CommandGetPropertyById
	 */
	static function createCommandGetPropertyById ($property, $loggedUser):CommandGetPropertyById {
		return new CommandGetPropertyById($property, $loggedUser);
	}
	//------------------------------------------------------------
	//----------------------------RATING---------------------------
	//------------------------------------------------------------
	/**
	 * @param Rating $rating
	 *
	 * @return CommandCreateRating
	 */
	static function createCommandCreateRatingByUserId ($rating):CommandCreateRating {
		return new CommandCreateRating($rating);
	}

	/**
	 * @param Rating $rating
	 *
	 * @return CommandDeleteRatingById
	 */
	static function createCommandDeleteRatingById ($rating):CommandDeleteRatingById {
		return new CommandDeleteRatingById($rating);
	}

	/**
	 * @param Rating $rating
	 *
	 * @return CommandGetRatingById
	 */
	static function createCommandGetRatingById ($rating):CommandGetRatingById {
		return new CommandGetRatingById($rating);
	}

	/**
	 * @param $rating
	 *
	 * @return CommandUpdateRating
	 */
	static function createCommandUpdateRatingById ($rating):CommandUpdateRating {
		return new CommandUpdateRating($rating);
	}

	/**
	 * @param $rating
	 *
	 * @return CommandActiveRating
	 */
	static function createCommandActiveRatingById ($rating):CommandActiveRating {
		return new CommandActiveRating($rating);
	}

	/**
	 * @param $rating
	 *
	 * @return CommandInactiveRating
	 */
	static function createCommandInactiveRatingById ($rating):CommandInactiveRating {
		return new CommandInactiveRating($rating);
	}

	/**
	 * @param User $user
	 *
	 * @return CommandGetAllRatingByUser
	 */
	static function createCommandGetAllRatingByUser ($user):CommandGetAllRatingByUser {
		return new CommandGetAllRatingByUser($user);
	}

	/**
	 * @param $key
	 *
	 * @return GetOriginByPublicKeyCommand
	 */
	public static function createCommandGetOriginByPublicKey ($key) {
		return new GetOriginByPublicKeyCommand($key);
	}

	/**
	 * @param int $id
	 * @param int $amount
	 * @param int $property
	 * @param int $creator
	 *
	 * @return CommandCreatePropertyExtra
	 */
	static function createCommandCreatePropertyExtra (int $id, int $amount, int $property,
		int $creator):CommandCreatePropertyExtra {
		return new CommandCreatePropertyExtra($id, $amount, $property, $creator);
	}

	/**
	 * @param int $id
	 * @param int $userModified
	 * @param     $dateModified
	 *
	 * @return CommandDeleteExtrasByPropertyId
	 */
	static function createCommandDeleteExtrasByPropertyId (
		int $id, int $userModified, $dateModified = null):CommandDeleteExtrasByPropertyId {
		return new CommandDeleteExtrasByPropertyId($id, $userModified, $dateModified);
	}

	/**
	 * @param int         $id
	 * @param             $extras
	 * @param int         $user
	 * @param string|null $dateModified
	 *
	 * @return CommandUpdatePropertyExtras
	 */
	static function createCommandUpdatePropertyExtras (int $id, $extras, int $user,
		string $dateModified = null):CommandUpdatePropertyExtras {
		return new CommandUpdatePropertyExtras($id, $extras, $user, $dateModified);
	}
	////////////////////////////////////////////////////////////////////////////
	//								FAVORITE
	////////////////////////////////////////////////////////////////////////////
	/**
	 * @param int $property
	 * @param int $user
	 *
	 * @return CommandCreateFavorite
	 */
	static function createCommandCreateFavorite ($property, $user) {
		return new CommandCreateFavorite($property, $user);
	}

	/**
	 * @param int $id
	 * @param     $user
	 *
	 * @return CommandDeleteFavorite
	 */
	static function createCommandDeleteFavorite ($id, $user) {
		return new CommandDeleteFavorite($id, $user);
	}

	/**
	 * @param int $id
	 *
	 * @return CommandGetAllFavoriteByUserId
	 */
	static function createCommandGetAllFavoriteByUserId ($id):CommandGetAllFavoriteByUserId {
		return new CommandGetAllFavoriteByUserId($id);
	}

	////////////////////////////////////////////////////////////////////////////
	//								SUBSCRIPTION DETAIL
	////////////////////////////////////////////////////////////////////////////
	/**
	 * @param Subscription         $subscription
	 * @param SubscriptionDetail[] $subscribeDetail
	 *
	 * @return CommandAddSubscribeDetail
	 */
	static function createCommandAddSubscribeDetail ($subscription, $subscribeDetail):CommandAddSubscribeDetail {
		return new CommandAddSubscribeDetail($subscription, $subscribeDetail);
	}

	/**
	 * @param Subscription            $subscription
	 * @param DtoSubscriptionDetail[] $subscriptionDetail
	 *
	 * @return CommandSubscribeUser
	 */
	static function createCommandSubscribeUser ($subscription, $subscriptionDetail):CommandSubscribeUser {
		return new CommandSubscribeUser($subscription, $subscriptionDetail);
	}

	/**
	 * @param int $subscription
	 *
	 * @return CommandApproveSubscription
	 */
	static function createCommandApproveSubscription ($subscription):CommandApproveSubscription {
		return new CommandApproveSubscription($subscription);
	}

	/**
	 * @param int $id
	 *
	 * @return CommandGetSubscription
	 */
	static function createCommandGetSubscription (int $id):CommandGetSubscription {
		return new CommandGetSubscription($id);
	}

	/**
	 * @return CommandGetAllSubscription
	 */
	static function createCommandGetAllSubscription ():CommandGetAllSubscription {
		return new CommandGetAllSubscription();
	}

	/**
	 * @param int $entity
	 *
	 * @return CommandDeleteSubscription
	 */
	static function createCommandDeleteSubscription (int $entity):CommandDeleteSubscription {
		return new CommandDeleteSubscription($entity);
	}

	/**
	 * @param int $id
	 * @param int $rol
	 * @param int $userModifier
	 * @param     $dateModified
	 *
	 * @return CommandUpdateUserRol
	 */
	static function createCommandUpdateUserRol (int $id, int $rol, int $userModifier,
		string $dateModified = null):CommandUpdateUserRol {
		return new CommandUpdateUserRol($id, $rol, $userModifier, $dateModified);
	}

	/**
	 * @param PasswordToken $passwordToken
	 *
	 * @return CommandCreatePasswordToken
	 */
	static function createCommandCreatePasswordToken ($passwordToken, $user):CommandCreatePasswordToken {
		return new CommandCreatePasswordToken($passwordToken, $user);
	}

	/**
	 * @param $token
	 * @param $user
	 *
	 * @return CommandGetPasswordTokenByToken
	 */
	static function createCommandGetPasswordTokenByToken ($token, $user):CommandGetPasswordTokenByToken {
		return new CommandGetPasswordTokenByToken($token, $user);
	}

	/**
	 * @param $user
	 *
	 * @return CommandDeletePasswordTokenByUserId
	 */
	static function createCommandDeletePasswordTokenByUserId ($user):CommandDeletePasswordTokenByUserId {
		return new CommandDeletePasswordTokenByUserId($user);
	}

	/**
	 * @return CommandGetAllPropertyDestiny
	 */
	static function createCommandGetAllPropertyDestiny ():CommandGetAllPropertyDestiny {
		return new CommandGetAllPropertyDestiny();
	}
}