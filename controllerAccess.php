<?php
require_once "vendor/autoload.php";
Tools::headers();
$get = Tools::getObject();
$headers = apache_request_headers();
$return = null;
$mapper = FactoryMapper::createMapperAccess();
$access = FactoryEntity::createAccess(0);
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				if (Validate::id($get)) {
					$command = FactoryCommand::createCommandGetAccessById($get->id);
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
					}
					catch (AccessNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_ACCESS_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_ACCESS_NOT_FOUND"));
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (CustomException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
				}
				else {
					$command = FactoryCommand::createCommandGetAllAccess();
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
					}
					catch (AccessNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ACCESS_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ACCESS_NOT_FOUND"));
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
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
	case "POST":
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				$post = json_decode(file_get_contents('php://input'));
				if (isset($post->name) && isset($post->abbreviation) && isset($post->user)) {
					try {
						//todo arreglar- permite agregar aun asi el nombre o el abbr se repitan.
						$command = FactoryCommand::createCommandCreateAccess($mapper->fromDtoToEntity($post));
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (AccessAlreadyExistException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_ACCESS_ALREADY_EXIST"));
						Tools::setResponse(Values::getValue("ERROR_ACCESS_ALREADY_EXIST"));
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
					$access = FactoryEntity::createAccess($get->id);
					$command = FactoryCommand::createCommandDeleteAccessById($access);
					try {
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (AccessNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ACCESS_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ACCESS_NOT_FOUND"));
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
