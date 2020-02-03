<?php
/**
 * Generated by Houston
 * Date: 19-Nov-19
 * Time: 12:29 PM
 */
class FactoryCommand {
	//------------------------------------------------------------
	//----------------------------ACCESS---------------------------
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
	//------------------------------------------------------------
	//----------------------------PLAN---------------------------
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
	//----------------------------LOCATION---------------------------
	//------------------------------------------------------------
	/**
	 * @param Location $location
	 *
	 * @return GetLocationByIdCommand
	 */
	static function createGetLocationByIdCommand ($location):GetLocationByIdCommand {
		return new GetLocationByIdCommand($location);
	}

	/**
	 * @param Location $location
	 *
	 * @return GetLocationsByTypeCommand
	 */
	static function createGetLocationsByTypeCommand ($location):GetLocationsByTypeCommand {
		return new GetLocationsByTypeCommand($location);
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
	 * @return CommandGetExtraById
	 */
	static function createCommandGetExtraById ($extra):CommandGetExtraById {
		return new CommandGetExtraById($extra);
	}

	/**
	 * @param Extra $extra
	 *
	 * @return DeleteExtraByIdCommand
	 */
	static function createDeleteExtraByIdCommand ($extra):DeleteExtraByIdCommand {
		return new DeleteExtraByIdCommand($extra);
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

	/**
	 * @param Property $property
	 *
	 * @return GetAllRequestByPropertyIdCommand
	 */
	static function createGetAllRequestByPropertyIdCommand ($property):GetAllRequestByPropertyIdCommand {
		return new GetAllRequestByPropertyIdCommand($property);
	}

	/**
	 * PropertyPrice
	 */
	/**
	 * @param PropertyPrice[] $property
	 *
	 * @return CreatePropertyPrice
	 */
	static function createCreatePropertyPriceByPropertyCommand ($property):CreatePropertyPrice {
		return new CreatePropertyPrice($property);
	}

	/**
	 * @param PropertyPrice $propertyPrice
	 *
	 * @return DeletePropertyPriceByIdCommand
	 */
	static function createDeletePropertyPriceByIdCommand ($propertyPrice):DeletePropertyPriceByIdCommand {
		return new DeletePropertyPriceByIdCommand($propertyPrice);
	}

	/**
	 * @return GetAllPropertyPriceCommand
	 */
	static function createGetAllPropertyPriceCommand ():GetAllPropertyPriceCommand {
		return new GetAllPropertyPriceCommand();
	}

	/**
	 * @param Property $property
	 *
	 * @return GetPropertyPriceByPropertyIdCommand
	 */
	static function createGetPropertyPriceByPropertyIdCommand ($property):GetPropertyPriceByPropertyIdCommand {
		return new GetPropertyPriceByPropertyIdCommand($property);
	}

	/**
	 * REQUEST
	 */
	/**
	 * @param Request $request
	 *
	 * @return CreateRequestCommand
	 */
	static function createCreateRequestCommand ($request):CreateRequestCommand {
		return new CreateRequestCommand($request);
	}

	/**
	 * @param $request
	 *
	 * @return DeleteRequestByIdCommand
	 */
	static function creatDeleteRequestByIdCommand ($request):DeleteRequestByIdCommand {
		return new DeleteRequestByIdCommand($request);
	}

	/**
	 * @return GetAllRequestCommand
	 */
	static function createGetAllRequestCommand ():GetAllRequestCommand {
		return new GetAllRequestCommand();
	}

	/**
	 * @param Request $request
	 *
	 * @return GetRequestByIdCommand
	 */
	static function createGetRequestByIdCommand ($request):GetRequestByIdCommand {
		return new GetRequestByIdCommand($request);
	}

	/**
	 * @param User $user
	 *
	 * @return GetAllRequestByUserIdCommand
	 */
	static function createGetAllRequestByUserIdCommand ($user):GetAllRequestByUserIdCommand {
		return new GetAllRequestByUserIdCommand($user);
	}

	/**
	 * RATING
	 */
	/**
	 * @param User $user
	 *
	 * @return CreateRatingByUserIdCommand
	 */
	static function createCreateRatingByUserIdCommand ($user):CreateRatingByUserIdCommand {
		return new CreateRatingByUserIdCommand($user);
	}

	/**
	 * @param Rating $rating
	 *
	 * @return DeleteRatingByIdCommand
	 */
	static function createDeleteRatingByIdCommand ($rating):DeleteRatingByIdCommand {
		return new DeleteRatingByIdCommand($rating);
	}

	/**
	 * @param Rating $rating
	 *
	 * @return GetRatingByIdCommand
	 */
	static function createGetRatingByIdCommand ($rating):GetRatingByIdCommand {
		return new GetRatingByIdCommand($rating);
	}

	/**
	 * @param User $user
	 *
	 * @return GetAllRatingByUserCommand
	 */
	static function createGetAllRatingByUserCommand ($user):GetAllRatingByUserCommand {
		return new GetAllRatingByUserCommand($user);
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

	/**
	 * @param User $user
	 *
	 * @return GetUserByUsernameCommand
	 */
	public static function createGetUserByUsernameCommand (User $user) {
		return new GetUserByUsernameCommand($user);
	}

	/**
	 * @param User $user
	 *
	 * @return GetUserByIdCommand
	 */
	public static function createGetUserByIdCommand (User $user):GetUserByIdCommand {
		return new GetUserByIdCommand($user);
	}
}