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
	 * @param $user
	 *
	 * @return CommandBlockUser
	 */
	static function createCommandBlockUser ($user):CommandBlockUser {
		return new CommandBlockUser($user);
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
	 * @param $user
	 *
	 * @return CommandUpdateUser
	 */
	static function createCommandUpdateUser ($user):CommandUpdateUser {
		return new CommandUpdateUser($user);
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
	 *
	 * @return CommandCreateRol
	 */
	static function createCommandCreateRol ($name, $access):CommandCreateRol {
		return new CommandCreateRol($name, $access);
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
	 * @param Request $request
	 *
	 * @return CommandGetRequestById
	 */
	static function createCommandGetRequestById ($request):CommandGetRequestById {
		return new CommandGetRequestById($request);
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
	 * @param $request
	 *
	 * @return CommandDeleteRequestById
	 */
	static function createCommandDeleteRequestById ($request):CommandDeleteRequestById {
		return new CommandDeleteRequestById($request);
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
	 * @param int $seat
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
	 * @param int $extra
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
	 * @param int $property
	 *
	 * @return GetAllExtrasByPropertyIdCommand
	 */
	static function createCommandGetAllExtrasByPropertyId ($property):GetAllExtrasByPropertyIdCommand {
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
	//------------------------------------------------------------
	//----------------------------PROPERTY-----------------------
	//------------------------------------------------------------
	/**
	 * @return CommandListProperties
	 */
	static function createCommandListProperties ():CommandListProperties {
		return new CommandListProperties();
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
	 * @param $property
	 *
	 * @return CommandActiveProperty
	 */
	static function createCommandActiveProperty ($property):CommandActiveProperty {
		return new CommandActiveProperty($property);
	}

	/**
	 * @param $property
	 *
	 * @return CommandInactiveProperty
	 */
	static function createCommandInactiveProperty ($property):CommandInactiveProperty {
		return new CommandInactiveProperty($property);
	}

	/**
	 * @param Property $property
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
	 * @param Property $property
	 *
	 * @return CommandDeletePropertyById
	 */
	static function createCommandDeletePropertyById ($property):CommandDeletePropertyById {
		return new CommandDeletePropertyById($property);
	}

	/**
	 * @return CommandGetAllProperty
	 */
	static function createCommandGetAllProperty ():CommandGetAllProperty {
		return new CommandGetAllProperty();
	}

	/**
	 * @param int $property
	 *
	 * @return CommandGetPropertyById
	 */
	static function createCommandGetPropertyById ($property):CommandGetPropertyById {
		return new CommandGetPropertyById($property);
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
	 * @param Origin $origin
	 *
	 * @return GetOriginByPublicKeyCommand
	 */
	public static function createCommandGetOriginByPublicKey (Origin $origin) {
		return new GetOriginByPublicKeyCommand($origin);
	}

	/**
	 * @param PropertyExtra[] $propertyExtra
	 *
	 * @return CommandCreatePropertyExtra
	 */
	static function createCommandCreatePropertyExtra ($propertyExtra):CommandCreatePropertyExtra {
		return new CommandCreatePropertyExtra($propertyExtra);
	}

	////////////////////////////////////////////////////////////////////////////
	//								FAVORITE
	////////////////////////////////////////////////////////////////////////////
	/**
	 * @param Favorite $favorite
	 *
	 * @return CommandCreateFavorite
	 */
	static function createCommandCreateFavorite ($favorite) {
		return new CommandCreateFavorite($favorite);
	}

	/**
	 * @param int $id
	 *
	 * @return CommandDeleteFavorite
	 */
	static function createCommandDeleteFavorite ($id) {
		return new CommandDeleteFavorite($id);
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
}