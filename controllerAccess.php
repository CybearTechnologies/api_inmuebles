<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperAccess();
$access = FactoryEntity::createAccess(0);
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$access->setId($get->id);
			$command = FactoryCommand::createGetAccessByIdCommand($access);
			try {
				$command->execute();
				$return = new ErrorResponse(true, $mapper->fromEntityToDto($command->return()));
				ErrorResponse::setResponse();
			}
			catch (AccessNotFoundException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ACCESS_NOT_FOUND"));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_DATABASE"));
				ErrorResponse::setResponse($exception->getCode());
			}
		}
		else {
			$command = FactoryCommand::createGetAllAccessCommand();
			try {
				$command->execute();
				$return = new ErrorResponse(true, $mapper->fromEntityArrayToDtoArray($command->return()));
				ErrorResponse::setResponse();
			}
			catch (AccessNotFoundException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ACCESS_NOT_FOUND"));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_DATABASE"));
				ErrorResponse::setResponse($exception->getCode());
			}
		}
		echo json_encode($return);
		break;
	case "POST":
		$post = json_decode(file_get_contents('php://input'));
		if (isset($get->name) && isset($get->abbreviation) && isset($get->user)) {
			try {
				$command = FactoryCommand::createCreateAccessCommand($mapper->fromDtoToEntity($post));
				$command->execute();
				$return = new ErrorResponse();
				ErrorResponse::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_DATABASE"));
				ErrorResponse::setResponse($exception->getCode());
			}
		}
		break;
	default:
		$http_response_header(404);
		break;
}
