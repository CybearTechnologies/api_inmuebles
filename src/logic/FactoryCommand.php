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
	 * @param RolAccess $rolAccess
	 *
	 * @return CommandActivateRolAccessById
	 */
	static function createCommandActivateRolAccess (RolAccess $rolAccess):CommandActivateRolAccessById {
		return new CommandActivateRolAccessById($rolAccess);
	}

	/**
	 * @param RolAccess $rolAccess
	 *
	 * @return CommandDeactivateRolAccessById
	 */
	static function createCommandDeactivateRolAccess (RolAccess $rolAccess):CommandDeactivateRolAccessById {
		return new CommandDeactivateRolAccessById($rolAccess);
	}
	//------------------------------------------------------------
	//----------------------------USER----------------------------
	//------------------------------------------------------------
	/**
	 * @param User $user
	 *
	 * @return CommandGetUserById
	 */
	public static function createCommandGetUserById (User $user):CommandGetUserById {
		return new CommandGetUserById($user);
	}

	/**
	 * @param User $user
	 *
	 * @return CommandGetUserByUsername
	 */
	public static function createCommandGetUserByUsername (User $user) {
		return new CommandGetUserByUsername($user);
	}
	//------------------------------------------------------------
	//----------------------------ROL----------------------------
	//------------------------------------------------------------
	/**
	 * @param Rol $rol
	 *
	 * @return CommandCreateRol
	 */
	static function createCommandCreateRol ($rol):CommandCreateRol {
		return new CommandCreateRol($rol);
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
	//------------------------------------------------------------
	//----------------------------REQUEST-------------------------
	//------------------------------------------------------------
	/**
	 * @param Request $request
	 *
	 * @return CommandCreateRequest
	 */
	static function createCommandCreateRequest ($request):CommandCreateRequest {
		return new CommandCreateRequest($request);
	}

	/**
	 * @return CommandGetAllRequest
	 */
	static function createCommandGetAllRequest ():CommandGetAllRequest {
		return new CommandGetAllRequest();
	}

	/**
	 * @param Request $request
	 *
	 * @return CommandGetRequestById
	 */
	static function createCommandGetRequestById ($request):CommandGetRequestById {
		return new CommandGetRequestById($request);
	}

	/**
	 * @param Property $property
	 *
	 * @return CommandGetAllRequestByPropertyId
	 */
	static function createCommandGetAllRequestByPropertyId ($property):CommandGetAllRequestByPropertyId {
		return new CommandGetAllRequestByPropertyId($property);
	}

	/**
	 * @param $request
	 *
	 * @return CommandDeleteRequestById
	 */
	static function createCommandDeleteRequestById ($request):CommandDeleteRequestById {
		return new CommandDeleteRequestById($request);
	}

	/**
	 * @param User $user
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
	//------------------------------------------------------------
	//----------------------------ACCESS--------------------------
	//------------------------------------------------------------
	/**
	 * @param Access $access
	 *
	 * @return CommandCreateAccess
	 */
	static function createCommandCreateAccess ($access):CommandCreateAccess {
		return new CommandCreateAccess($access);
	}

	/**
	 * @return CommandGetAllAccess
	 */
	static function createCommandGetAllAccess ():CommandGetAllAccess {
		return new CommandGetAllAccess();
	}

	/**
	 * @param Access $access
	 *
	 * @return CommandGetAccessById
	 */
	static function createCommandGetAccessById ($access):CommandGetAccessById {
		return new CommandGetAccessById($access);
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
	 * @param Access $access
	 *
	 * @return CommandDeleteAccessById
	 */
	static function createCommandDeleteAccessById ($access):CommandDeleteAccessById {
		return new CommandDeleteAccessById($access);
	}
	//------------------------------------------------------------
	//----------------------------SEAT---------------------------
	//------------------------------------------------------------
	/**
	 * @param Seat $seat
	 *
	 * @return CommandCreateSeat
	 */
	static function createCommandCreateSeat (Seat $seat):CommandCreateSeat {
		return new CommandCreateSeat($seat);
	}

	/**
	 * @return CommandGetAllSeats
	 */
	static function createCommandGetAllSeats ():CommandGetAllSeats {
		return new CommandGetAllSeats();
	}

	/**
	 * @param Seat $seat
	 *
	 * @return CommandGetSeatById
	 */
	static function createCommandGetSeatById ($seat):CommandGetSeatById {
		return new CommandGetSeatById($seat);
	}

	/**
	 * @param Agency $agency
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
	 * @param Agency $agency
	 *
	 * @return CommandGetAgencyById
	 */
	static function createCommandGetAgencyById ($agency):CommandGetAgencyById {
		return new CommandGetAgencyById($agency);
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
	static function createUpdatePlanCommand ($plan):CommandUpdatePlan {
		return new CommandUpdatePlan($plan);
	}

	/**
	 * @param Plan $plan
	 *
	 * @return CommandDeletePlanById
	 */
	static function createDeletePlanByIdCommand ($plan):CommandDeletePlanById {
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
	 * @param PropertyType $propertyType
	 *
	 * @return CommandGetPropertyTypeById
	 */
	static function createCommandGetPropertyTypeById ($propertyType):CommandGetPropertyTypeById {
		return new CommandGetPropertyTypeById($propertyType);
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
	 * @param PropertyPrice $propertyPrice
	 *
	 * @return CommandCreatePropertyPrice
	 */
	static function createCommandCreatePropertyPrice ($propertyPrice):CommandCreatePropertyPrice {
		return new CommandCreatePropertyPrice($propertyPrice);
	}

	/**
	 * @param int $property
	 *
	 * @return CommandGetPropertyPriceByPropertyId
	 */
	static function createCommandGetPropertyPriceByPropertyId ($property):CommandGetPropertyPriceByPropertyId {
		return new CommandGetPropertyPriceByPropertyId($property);
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
	 * @param Extra $extra
	 *
	 * @return CommandCreateExtra
	 */
	static function createCommandCreateExtra ($extra):CommandCreateExtra {
		return new CommandCreateExtra($extra);
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
	 * @param Extra $extra
	 *
	 * @return CommandGetExtraById
	 */
	static function createCommandGetExtraById ($extra):CommandGetExtraById {
		return new CommandGetExtraById($extra);
	}

	/**
	 * @param Extra $extra
	 *
	 * @return CommandDeleteExtraById
	 */
	static function createCommandDeleteExtraById ($extra):CommandDeleteExtraById {
		return new CommandDeleteExtraById($extra);
	}

	/**
	 * @param Property $property
	 *
	 * @return GetAllExtrasByPropertyIdCommand
	 */
	static function createGetAllExtrasByPropertyIdCommand ($property):GetAllExtrasByPropertyIdCommand {
		return new GetAllExtrasByPropertyIdCommand($property);
	}

	/**
	 * @param $extra
	 *
	 * @return CommandUpdateExtra
	 */
	static function createCommandUpdateExtraById ($extra):CommandUpdateExtra {
		return new CommandUpdateExtra($extra);
	}

	/**
	 * @param $extra
	 *
	 * @return CommandActiveExtra
	 */
	static function createCommandActiveExtraById ($extra):CommandActiveExtra {
		return new CommandActiveExtra($extra);
	}

	/**
	 * @param $extra
	 *
	 * @return CommandInactiveExtra
	 */
	static function createCommandInactiveExtraById ($extra):CommandInactiveExtra {
		return new CommandInactiveExtra($extra);
	}

	/**
	 * PROPERTY
	 */
	/**
	 * @param Property $property
	 *
	 * @return CreatePropertyCommand
	 */
	static function createCreatePropertyCommand ($property):CreatePropertyCommand {
		return new CreatePropertyCommand($property);
	}

	/**
	 * @return CommandGetAllActiveProperties
	 */
	static function createCommandGetAllActiveProperties ():CommandGetAllActiveProperties {
		return new CommandGetAllActiveProperties();
	}

	/**
	 * @return CommandGetAllUserProperties
	 */
	static function createCommandGetAllUserProperties ():CommandGetAllUserProperties {
		return new CommandGetAllUserProperties();
	}

	/**
	 * @return CommandGetAllPropertiesByType
	 */
	static function createCommandGetAllPropertiesByType ():CommandGetAllPropertiesByType {
		return new CommandGetAllPropertiesByType();
	}

	/**
	 * @param Property $property
	 *
	 * @return DeletePropertyByIdCommand
	 */
	static function createDeletePopertyByIdCommand ($property):DeletePropertyByIdCommand {
		return new DeletePropertyByIdCommand($property);
	}

	/**
	 * @return GetAllPropertyCommand
	 */
	static function createGetAllPropertyCommand ():GetAllPropertyCommand {
		return new GetAllPropertyCommand();
	}

	/**
	 * @param Property $property
	 *
	 * @return GetPropertyByIdCommand
	 */
	static function createGetPropertyByIdCommand ($property):GetPropertyByIdCommand {
		return new GetPropertyByIdCommand($property);
	}
	//------------------------------------------------------------
	//----------------------------RATING---------------------------
	//------------------------------------------------------------
	/**
	 * @param Rating $rating
	 *
	 * @return CommandCreateRating
	 */
	static function createCreateRatingByUserIdCommand ($rating):CommandCreateRating {
		return new CommandCreateRating($rating);
	}

	/**
	 * @param Rating $rating
	 *
	 * @return CommandDeleteRatingById
	 */
	static function createDeleteRatingByIdCommand ($rating):CommandDeleteRatingById {
		return new CommandDeleteRatingById($rating);
	}

	/**
	 * @param Rating $rating
	 *
	 * @return CommandGetRatingById
	 */
	static function createGetRatingByIdCommand ($rating):CommandGetRatingById {
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
	static function createGetAllRatingByUserCommand ($user):CommandGetAllRatingByUser {
		return new CommandGetAllRatingByUser($user);
	}

	/**
	 * @param Agency $agency
	 *
	 * @return CommandGetAgencyByName
	 */
	public static function createGetAgencyByNameCommand ($agency):CommandGetAgencyByName {
		return new CommandGetAgencyByName($agency);
	}

	/**
	 * @param Origin $origin
	 *
	 * @return GetOriginByPublicKeyCommand
	 */
	public static function createGetOriginByPublicKeyCommand (Origin $origin) {
		return new GetOriginByPublicKeyCommand($origin);
	}
}