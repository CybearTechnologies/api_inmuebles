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
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (AccessNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ACCESS_NOT_FOUND"));
				Tools::setResponse($exception->getCode());
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
		}
		else {
			$command = FactoryCommand::createGetAllAccessCommand();
			try {
				$command->execute();
				$return = new ErrorResponse($mapper->fromEntityArrayToDtoArray($command->return()));
				Tools::setResponse();
			}
			catch (AccessNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ACCESS_NOT_FOUND"));
				Tools::setResponse($exception->getCode());
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
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
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
			catch (AccessAlreadyExistException $e) {
			}
		}
		break;
	default:
		$http_response_header(404);
		break;
}
