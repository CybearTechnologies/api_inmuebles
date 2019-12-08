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
				$return = new Result(true, $mapper->fromEntityToDto($command->return()));
				Result::setResponse();
			}
			catch (AccessNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("ACCESS_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("DATABASE_ERROR"));
				Result::setResponse($exception->getCode());
			}
		}
		else {
			$command = FactoryCommand::createGetAllAccessCommand();
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityArrayToDtoArray($command->return()));
				Result::setResponse();
			}
			catch (AccessNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("ACCESS_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("DATABASE_ERROR"));
				Result::setResponse($exception->getCode());
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
				$return = new Result();
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("DATABASE_ERROR"));
				Result::setResponse($exception->getCode());
			}
		}
		break;
	default:
		$http_response_header(404);
		break;
}
