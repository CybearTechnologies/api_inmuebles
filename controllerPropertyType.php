<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperPropertyType();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$propertyType = FactoryEntity::createPropertyType($get->id);
			$command = FactoryCommand::createCommandGetPropertyTypeById($propertyType);
			try {
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (PropertyTypeNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_PROPERTY_NOT_FOUND"));
			}
		}
		else {
			$command = FactoryCommand::createCommandGetAllPropertyType();
			try {
				$command->execute();
				$return = $mapper->fromEntityArrayToDTOArray($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (PropertyTypeNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_TYPES_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_PROPERTY_TYPES_NOT_FOUND"));
			}
		}
		echo json_encode($return);
		break;
	case "POST":
		$post = json_decode(file_get_contents('php://input'));
		if (Validate::propertyType($post)) {
			try {
				$command = FactoryCommand::createCommandCreatePropertyType($mapper->fromDTOToEntity($post));
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (PropetyTypeAlreadyExistException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_TYPE_ALREADY_EXIST"));
				Tools::setResponse(Values::getValue("ERROR_PROPERTY_TYPE_ALREADY_EXIST"));
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(Values::getValue("ERROR_DATA_INCOMPLETE"));
		}
		echo json_encode($return);
		break;
	default:
		Tools::setResponse(405);
		break;
}