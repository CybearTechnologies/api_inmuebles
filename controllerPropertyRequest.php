<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperRequest();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->property) && is_numeric($get->property)) {
			try {
				$command = FactoryCommand::createCommandGetAllRequestByPropertyId($get->property);
				$command->execute();
				$return = $mapper->fromEntityArrayToDtoArray($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (RequestNotFoundException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_REQUEST_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_REQUEST_NOT_FOUND"));
			}
		}
		if (isset($get->user) && is_numeric($get->user)) {
			$command = FactoryCommand::createCommandGetAllRequestByUserId($get->user);
			try {
				$command->execute();
				$return = $mapper->fromEntityArrayToDtoArray($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (RequestNotFoundException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_REQUEST_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_REQUEST_NOT_FOUND"));
			}
		}
		echo json_encode($return);
		break;
	case "POST":
		if (isset($post->property) && is_numeric($post->property) && isset($post->user) && is_numeric($post->user)) {
			try {
				$command = FactoryCommand::createCommandCreateRequest(
					FactoryEntity::createRequest(-1, $post->property, $post->user));
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
		}
		echo json_encode($return);
		break;
	case "PUT":
		echo json_encode($return);
		break;
	case "DELETE":
		echo json_encode($return);
		break;
	default:
		Tools::setResponse(405);
		break;
}