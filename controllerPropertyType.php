<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperPropertyType();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$command = FactoryCommand::createGetPropertyTypeByIdCommand($get->id);
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityToDTO($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("DATABASE_ERROR"));
				Result::setResponse($exception->getCode());
			}
			catch (PropertyTypeNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("PROPERTY_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
		}
		else {
			$command = FactoryCommand::createGetAllPropertyTypeCommand();
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityArrayToDTOArray($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("DATABASE_ERROR"));
				Result::setResponse($exception->getCode());
			}
			catch (PropertyTypeNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("PROPERTY_TYPES_NOT_FOUND"));
				Result::setResponse($exception->getCode());
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
				$return = new Result();
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("DATABASE_ERROR"));
				Result::setResponse($exception->getCode());
			}
			catch (PropertyTypeNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("PROPERTY_TYPE_NOT_FOUND"));
			}
			catch (PropetyTypeAlreadyExistException $exception) {
				$return = new Result(false, [], Values::getText("PROPERTY_TYPE_ALREADY_EXIST"));
			}
		}
		else {
			$return = new Result(false, [], Values::getText("DATA_INCOMPLETE"));
			Result::setResponse(500);
		}
		echo json_encode($return);
		break;
	default:
		$http_response_header(404);
		break;
}