<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperPropertyType();
$propertyType = FactoryEntity::createPropertyType(0);
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$propertyType->setId($get->id);
			$command = FactoryCommand::createGetPropertyTypeByIdCommand($propertyType);
			try {
				$command->execute();
				$return = new ErrorResponse($mapper->fromEntityToDTO($command->return()));
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
			catch (PropertyTypeNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_NOT_FOUND"));
				Tools::setResponse($exception->getCode());
			}
		}
		else {
			$command = FactoryCommand::createGetAllPropertyTypeCommand();
			try {
				$command->execute();
				$return = new ErrorResponse($mapper->fromEntityArrayToDTOArray($command->return()));
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
			catch (PropertyTypeNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_TYPES_NOT_FOUND"));
				Tools::setResponse($exception->getCode());
			}
		}
		echo json_encode($return);
		break;
	case "POST":
		$post = json_decode(file_get_contents('php://input'));
		if (isset($post->name)) {
			try {
				$command = FactoryCommand::createPropertyTypeCommand($mapper->fromDTOToEntity($post));
				$command->execute();
				$return = new ErrorResponse();
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
			catch (PropertyTypeNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_TYPE_NOT_FOUND"));
			}
			catch (PropetyTypeAlreadyExistException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_TYPE_ALREADY_EXIST"));
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(500);
		}
		echo json_encode($return);
		break;
	default:
		$http_response_header(404);
		break;
}