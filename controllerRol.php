<?php
require_once "vendor/autoload.php";
Tools::headers();
$get = Tools::getObject();
$headers = apache_request_headers();
$return = null;
$mapper = FactoryMapper::createMapperRol();
$rol = FactoryEntity::createRol(0);
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
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
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (OriginNotFoundException $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse(Values::getText('ERROR_ORIGIN_NOT_FOUND'));
				Tools::setResponse(Values::getValue('ERROR_ORIGIN_NOT_FOUND'));
			}
			catch (InvalidJWTException $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse($exception->getMessage());
				Tools::setResponse(Values::getValue('ERROR_LOGIN_USER_NOT_LOGGED'));
			}
			catch (Exception $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse($exception->getMessage());
				Tools::setResponse(Values::getValue('ERROR_LOGIN_USER_NOT_LOGGED'));
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_HEADER"));
			Tools::setResponse(Values::getValue("ERROR_HEADER"));
		}
		echo json_encode($return);
		break;
	case "POST":
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				$post = json_decode(file_get_contents('php://input'));
				if (Validate::rol($post)) {
					$command = FactoryCommand::createCommandCreateRol($post->name, $post->access,$loggedUser);
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
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (OriginNotFoundException $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse(Values::getText('ERROR_ORIGIN_NOT_FOUND'));
				Tools::setResponse(Values::getValue('ERROR_ORIGIN_NOT_FOUND'));
			}
			catch (InvalidJWTException $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse($exception->getMessage());
				Tools::setResponse(Values::getValue('ERROR_LOGIN_USER_NOT_LOGGED'));
			}
			catch (Exception $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse($exception->getMessage());
				Tools::setResponse(Values::getValue('ERROR_LOGIN_USER_NOT_LOGGED'));
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_HEADER"));
			Tools::setResponse(Values::getValue("ERROR_HEADER"));
		}
		echo json_encode($return);
		break;
	case "PUT":
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				$put = json_decode(file_get_contents('php://input'));
				if (Validate::putRol($put)) {
					try {
						$rol = $mapper->fromDtoToEntity($put);
						$rol->setUserModifier($loggedUser);
						$command = FactoryCommand::createCommandUpdateRol($rol);
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
						$rol = FactoryEntity::createRol($get->id);
						$rol->setUserModifier($loggedUser);
						$command = FactoryCommand::createCommandActivateRol($rol);
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
						$rol = FactoryEntity::createRol($get->id);
						$rol->setUserModifier($loggedUser);
						$command = FactoryCommand::createCommandInactiveRol($rol);
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
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (OriginNotFoundException $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse(Values::getText('ERROR_ORIGIN_NOT_FOUND'));
				Tools::setResponse(Values::getValue('ERROR_ORIGIN_NOT_FOUND'));
			}
			catch (InvalidJWTException $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse($exception->getMessage());
				Tools::setResponse($exception->getCode());
			}
			catch (Exception $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse($exception->getMessage());
				Tools::setResponse($exception->getCode());
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_HEADER"));
			Tools::setResponse(Values::getValue("ERROR_HEADER"));
		}
		echo json_encode($return);
		break;
	case "DELETE":
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				if (Validate::id($get)) {
					$rol = FactoryEntity::createRol($get->id);
					$rol->setUserModifier($loggedUser);
					$command = FactoryCommand::createCommandDeleteRol($rol);
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
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (OriginNotFoundException $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse(Values::getText('ERROR_ORIGIN_NOT_FOUND'));
				Tools::setResponse(Values::getValue('ERROR_ORIGIN_NOT_FOUND'));
			}
			catch (InvalidJWTException $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse($exception->getMessage());
				Tools::setResponse($exception->getCode());
			}
			catch (Exception $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse($exception->getMessage());
				Tools::setResponse($exception->getCode());
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_HEADER"));
			Tools::setResponse(Values::getValue("ERROR_HEADER"));
		}
		echo json_encode($return);
		break;
	default:
		Tools::setResponse(405);
		break;
}