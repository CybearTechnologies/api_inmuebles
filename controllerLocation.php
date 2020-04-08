<?php
require_once "vendor/autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperLocation();
$location = FactoryEntity::createLocation(-1);
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::id($get)) {
			$location->setId($get->id);
			$command = FactoryCommand::createCommandGetLocationById($location);
			try {
				$command->execute();
				$return = $command->return();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (LocationNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_LOCATION_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_LOCATION_NOT_FOUND"));
			}
			echo json_encode($return);
		}
		elseif (isset($get->type)) {
			$location->setType($get->type);
			$command = FactoryCommand::createCommandGetLocationsByType($location);
			try {
				$command->execute();
				$return = $mapper->fromEntityArrayToDTOArray($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (LocationNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_LOCATION_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_LOCATION_NOT_FOUND"));
			}
		}
		elseif (isset($get->state)) {
			$command = FactoryCommand::createCommandGetAllTownByState($get->state);
			try {
				$command->execute();
				$return = $command->return();
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (LocationNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_LOCATION_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_LOCATION_NOT_FOUND"));
			}
		}
		echo json_encode($return);
		break;
}
