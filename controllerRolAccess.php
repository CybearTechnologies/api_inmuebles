<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperRolAccess();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::id($get)) {
			$command = FactoryCommand::createCommandGetAccessByRol(FactoryEntity::createRolAccess(-1, $get->id));
			try {
				$command->execute();
				$return = $command->return();
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
			catch (RolAccessNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_ROL_ACCESS_NOT_FOUND"));
				Tools::setResponse($exception->getCode());
			}
			catch (CustomException $exception) {
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
	case "POST":
		$post = json_decode(file_get_contents('php://input'));
		if (Validate::rolAccess($post)) {
			$command = FactoryCommand::createCommandCreateRolAccess($mapper->fromDtoToEntity($post));
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
			Tools::setResponse(Values::getValue("ERROR_DATA_INCOMPLETE"));
		}
		echo json_encode($return);
		break;
	case "PUT":
		if (Validate::activateRolAccess($get)) {
			$command = FactoryCommand::createCommandActivateRolAccess(FactoryEntity::createRolAccess($get->id));
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (RolAccessNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_ROL_ACCESS_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_ROL_ACCESS_NOT_FOUND"));
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
		}
		elseif (Validate::inactivateRolAccess($get)) {
			$command = FactoryCommand::createCommandDeactivateRolAccess(FactoryEntity::createRolAccess($get->id));
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (RolAccessNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_ROL_ACCESS_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_ROL_ACCESS_NOT_FOUND"));
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
	default:
		Tools::setResponse(405);
		break;
}