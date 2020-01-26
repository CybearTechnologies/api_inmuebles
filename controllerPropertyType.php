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
				$return = new ErrorResponse(true, $mapper->fromEntityToDTO($command->return()));
				ErrorResponse::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_DATABASE"));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (PropertyTypeNotFoundException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_PROPERTY_NOT_FOUND"));
				ErrorResponse::setResponse($exception->getCode());
			}
		}
		else {
			$command = FactoryCommand::createGetAllPropertyTypeCommand();
			try {
				$command->execute();
				$return = new ErrorResponse(true, $mapper->fromEntityArrayToDTOArray($command->return()));
				ErrorResponse::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_DATABASE"));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (PropertyTypeNotFoundException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_PROPERTY_TYPES_NOT_FOUND"));
				ErrorResponse::setResponse($exception->getCode());
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
				ErrorResponse::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_DATABASE"));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (PropertyTypeNotFoundException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_PROPERTY_TYPE_NOT_FOUND"));
			}
			catch (PropetyTypeAlreadyExistException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_PROPERTY_TYPE_ALREADY_EXIST"));
			}
		}
		else {
			$return = new ErrorResponse(false, [], Values::getText("ERROR_DATA_INCOMPLETE"));
			ErrorResponse::setResponse(500);
		}
		echo json_encode($return);
		break;
	default:
		$http_response_header(404);
		break;
}