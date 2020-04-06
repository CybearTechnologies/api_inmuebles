<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperRol();
$rol = FactoryEntity::createRol(0);
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::id($get)) {
			$command = FactoryCommand::createCommandGetRolById($get->id);
			try {
				$command->execute();
				$return = $command->return();
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (RolNotFoundException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_ROL_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_ROL_NOT_FOUND"));
			}
			catch (CustomException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
		}
		else {
			$command = FactoryCommand::createCommandGetAllRoles();
			try {
				$command->execute();
				$return = $mapper->fromEntityArrayToDtoArray($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (RolNotFoundException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_ROL_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_ROL_NOT_FOUND"));
			}
		}
		echo json_encode($return);
		break;
	case "POST":
		$post = json_decode(file_get_contents('php://input'));
		if (Validate::rol($post)) {
			$command = FactoryCommand::createCommandCreateRol($post->name, $post->access);
			try {
				$command->execute();
				$return = $command->return();
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(Values::getValue("ERROR_DATA_INCOMPLETE"));
		}
		echo json_encode($return);
		break;
	case "PUT":
		$put = json_decode(file_get_contents('php://input'));
		if (Validate::putRol($put)) {
			try {
				$command = FactoryCommand::createCommandUpdateRol($mapper->fromDtoToEntity($put));
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (RolNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_ROL_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_ROL_NOT_FOUND"));
			}
		}
		elseif (isset($get->id) && is_numeric($get->id) && strtolower($get->action) == "active") {
			try {
				$command = FactoryCommand::createCommandActivateRol(FactoryEntity::createRol($get->id));
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (RolNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_ROL_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_ROL_NOT_FOUND"));
			}
		}
		elseif (isset($get->id) && is_numeric($get->id) && strtolower($get->action) == "inactive") {
			try {
				$command = FactoryCommand::createCommandInactiveRol(FactoryEntity::createRol($get->id));
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (RolNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_ROL_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_ROL_NOT_FOUND"));
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(Values::getValue("ERROR_DATA_INCOMPLETE"));
		}
		echo json_encode($return);
		break;
	case "DELETE":
		if (Validate::id($get)) {
			$command = FactoryCommand::createCommandDeleteRol(FactoryEntity::createRol($get->id));
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (RolNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_ROL_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_ROL_NOT_FOUND"));
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(500);
		}
		echo json_encode($return);
		break;
	default:
		Tools::setResponse(405);
		break;
}