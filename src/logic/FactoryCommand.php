<?php
/**
 * Generated by Houston
 * Date: 19-Nov-19
 * Time: 12:29 PM
 */
class FactoryCommand {
	//------------------------------------------------------------
	//----------------------------AGENCY---------------------------
	//------------------------------------------------------------
	/**
	 * @param Agency $agency
	 *
	 * @return CommandCreateAgency
	 */
	static function createCreateAgencyCommand ($agency):CommandCreateAgency {
		return new CommandCreateAgency($agency);
	}

	/**
	 * @return CommandGetAllAgencies
	 */
	static function createGetAllAgenciesCommand ():CommandGetAllAgencies {
		return new CommandGetAllAgencies();
	}

	/**
	 * @param Agency $agency
	 *
	 * @return CommandGetAgencyById
	 */
	static function createGetAgencyByIdCommand ($agency):CommandGetAgencyById {
		return new CommandGetAgencyById($agency);
	}

	/**
	 * @param Agency $agency
	 *
	 * @return CommandDeleteAgencyById
	 */
	static function createDeleteAgencyByIdCommand ($agency):CommandDeleteAgencyById {
		return new CommandDeleteAgencyById($agency);
	}
	//------------------------------------------------------------
	//----------------------------PLAN---------------------------
	//------------------------------------------------------------
	/**
	 * @param Plan $plan
	 *
	 * @return CreatePlanCommand
	 */
	static function createCreatePlanCommand ($plan):CreatePlanCommand {
		return new CreatePlanCommand($plan);
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

	/**
	 * @return GetAllPlanCommand
	 */
	static function createGetAllPlanCommand ():GetAllPlanCommand {
		return new GetAllPlanCommand();
	}

	/**
	 * @param Plan $plan
	 *
	 * @return GetPlanByIdCommand
	 */
	static function createGetPlanByIdCommand ($plan):GetPlanByIdCommand {
		return new GetPlanByIdCommand($plan);
	}

	/**
	 * @param Plan $plan
	 *
	 * @return GetPlanByNameCommand
	 */
	static function createGetPlanByNameCommand ($plan):GetPlanByNameCommand {
		return new GetPlanByNameCommand($plan);
	}

	/**
	 * @param Plan $plan
	 *
	 * @return UpdatePlanCommand
	 */
	static function createUpdatePlanCommand ($plan):UpdatePlanCommand {
		return new UpdatePlanCommand($plan);
	}

	/**
	 * @param Plan $plan
	 *
	 * @return DeletePlanByIdCommand
	 */
	static function createDeletePlanByIdCommand ($plan):DeletePlanByIdCommand {
		return new DeletePlanByIdCommand($plan);
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
	 *ACCESS
	 *
	 * @param Access $access
	 *
	 * @return CreateAccessCommand
	 */
	static function createCreateAccessCommand ($access):CreateAccessCommand {
		return new CreateAccessCommand($access);
	}

	/**
	 * @param Access $access
	 *
	 * @return GetAccessByAbbreviationCommand
	 */
	static function createGetAccessByAbbreviationCommand ($access):GetAccessByAbbreviationCommand {
		return new GetAccessByAbbreviationCommand($access);
	}

	/**
	 * @param Access $access
	 *
	 * @return DeleteAccessByIdCommand
	 */
	static function createDeleteAccessByIdCommand ($access):DeleteAccessByIdCommand {
		return new DeleteAccessByIdCommand($access);
	}

	/**
	 * @param Access $access
	 *
	 * @return GetAccessByIdCommand
	 */
	static function createGetAccessByIdCommand ($access):GetAccessByIdCommand {
		return new GetAccessByIdCommand($access);
	}

	/**
	 * @param Access $access
	 *
	 * @return GetAccessByNameCommand
	 */
	static function createGetAccessByNameCommand ($access):GetAccessByNameCommand {
		return new GetAccessByNameCommand($access);
	}

	/**
	 * @return GetAllAccessCommand
	 */
	static function createGetAllAccessCommand ():GetAllAccessCommand {
		return new GetAllAccessCommand();
	}

	/**
	 * @param Agency $agency
	 *
	 * @return GetAllSeatsByAgencyCommand
	 */
	static function createGetAllSeatsByAgencyCommand ($agency):GetAllSeatsByAgencyCommand {
		return new GetAllSeatsByAgencyCommand($agency);
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
	 * SEATS
	 */
	/**
	 * @param Seat $seat
	 *
	 * @return CreateSeatCommand
	 */
	static function createCreateSeatCommand (Seat $seat):CreateSeatCommand {
		return new CreateSeatCommand($seat);
	}

	/**
	 * @param $seat
	 *
	 * @return DeleteSeatByIdCommand
	 */
	static function createDeleteSeatByIdCommand ($seat):DeleteSeatByIdCommand {
		return new DeleteSeatByIdCommand($seat);
	}

	/**
	 * @return GetAllSeatsCommand
	 */
	static function createGetAllSeatCommand ():GetAllSeatsCommand {
		return new GetAllSeatsCommand();
	}

	/**
	 * @param Seat $seat
	 *
	 * @return GetSeatByIdCommand
	 */
	static function createGetSeatByIdCommand ($seat):GetSeatByIdCommand {
		return new GetSeatByIdCommand($seat);
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