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
			$command = FactoryCommand::createCommandGetAccessById($access);
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (AccessNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_ACCESS_NOT_FOUND"));
				Tools::setResponse($exception->getCode());
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
		}
		else {
			$command = FactoryCommand::createCommandGetAllAccess();
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
		if (isset($post->name) && isset($post->abbreviation) && isset($post->user)) {
			try {
				$command = FactoryCommand::createCommandCreateAccess($mapper->fromDtoToEntity($post));
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
			catch (AccessAlreadyExistException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_ACCESS_ALREADY_EXIST"));
				Tools::setResponse($exception->getCode());
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(Values::getValue("ERROR_DATA_INCOMPLETE"));
		}
		echo json_encode($return);
		break;
	default:
		Tools::setResponse(404);
		break;
}
