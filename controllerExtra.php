<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperExtra();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$extra = FactoryEntity::createExtra($get->id);
			$command = FactoryCommand::createCommandGetExtraById($extra);
			try {
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
			catch (ExtraNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_EXTRA_NOT_FOUND"));
				Tools::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		else {
			$command = FactoryCommand::createCommandGetAllExtra();
			try {
				$command->execute();
				$return = $mapper->fromEntityArrayToDTOArray($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
			catch (ExtraNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_EXTRAS_NOT_FOUND"));
				Tools::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		break;
	case "POST":
		$post = json_decode(file_get_contents('php://input'));
		if (Validate::extra($post)) {
			$command = FactoryCommand::createCommandCreateExtra($mapper->fromDTOToEntity($post));
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(500);
		}
		echo json_encode($return);
		break;
	case "DELETE":
		if (isset($get->id) && is_numeric($get->id)) {
			$extra = FactoryEntity::createExtra($get->id);
			$command = FactoryCommand::createCommandDeleteExtraById($extra);
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(500);
		}
		echo json_encode($return);
		break;
	default:
		Tools::setResponse(404);
		break;
}
