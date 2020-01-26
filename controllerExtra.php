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
			$command = FactoryCommand::createGetExtraByIdCommand($extra);
			try {
				$command->execute();
				$return = new ErrorResponse(true, $mapper->fromEntityToDTO($command->return()));
				ErrorResponse::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_DATABASE"));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (ExtraNotFoundException $exception) {
				$return = new ErrorResponse(true, [], Values::getText("ERROR_EXTRA_NOT_FOUND"));
				ErrorResponse::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		else {
			$command = FactoryCommand::createGetAllExtraCommand();
			try {
				$command->execute();
				$return = new ErrorResponse(true, $mapper->fromEntityArrayToDTOArray($command->return()));
				ErrorResponse::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_DATABASE"));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (ExtraNotFoundException $exception) {
				$return = new ErrorResponse(true, [], Values::getText("ERROR_EXTRAS_NOT_FOUND"));
				ErrorResponse::setResponse($exception->getCode());
			}
			http_response_code(200);
			echo json_encode($return);
		}
		break;
}
