<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperLocation();
$location = FactoryEntity::createLocation(-1);
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$location->setId($get->id);
			$command = FactoryCommand::createGetLocationByIdCommand($location);
			try {
				$command->execute();
				$return = new ErrorResponse(true, $mapper->fromEntityToDTO($command->return()));
				ErrorResponse::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_DATABASE"));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (LocationNotFoundException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_LOCATION_NOT_FOUND"));
				ErrorResponse::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		elseif (isset($get->type)) {
			$location->setType($get->type);
			$command = FactoryCommand::createGetLocationsByTypeCommand($location);
			try {
				$command->execute();
				$return = new ErrorResponse(true, $mapper->fromEntityArrayToDTOArray($command->return()));
				ErrorResponse::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_DATABASE"));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (LocationNotFoundException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_LOCATION_NOT_FOUND"));
				ErrorResponse::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		break;
}
