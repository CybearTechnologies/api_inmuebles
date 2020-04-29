<?php
require_once "vendor/autoload.php";
Tools::headers();
$headers = apache_request_headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperUser();
$user = FactoryEntity::createUser(0);
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				if (isset($get->email) && is_string($get->email)) {
					$user->setEmail($get->email);
					$command = FactoryCommand::createCommandGetUserByUsername($user);
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = Values::getText("ERROR_DATABASE");
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (MultipleUserException $exception) {
						$return = Values::getText("ERROR_MULTIPLE_USER");
						Tools::setResponse(Values::getValue("ERROR_MULTIPLE_USER"));
					}
					catch (UserNotFoundException $exception) {
						$return = Values::getText("ERROR_USER_NOT_FOUND");
						Tools::setResponse(Values::getValue("ERROR_USER_NOT_FOUND"));
					}
				}
				else {
					$command = FactoryCommand::createCommandGetAllUser();
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $e) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (UserNotFoundException $e) {
						$return = new ErrorResponse(Values::getText("ERROR_USER_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_USER_NOT_FOUND"));
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
	case "PUT":
		$put = json_decode(file_get_contents('php://input'));
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				if (Validate::putRol($put)) { //TODO condition validate (???)
					try {
						$command = FactoryCommand::createCommandUpdateUser($mapper->fromDtoToEntity($put));
						$command->execute();
						$return = $mapper->fromEntityToDTO($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (UserNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_USER_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_USER_NOT_FOUND"));
					}
				}
				elseif (isset($get->id) && is_numeric($get->id) && strtolower($get->action) == "active") {
					try {
						$command = FactoryCommand::createCommandActivateUser(FactoryEntity::createUser($get->id));
						$command->execute();
						$return = $mapper->fromEntityToDTO($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (UserNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_USER_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_USER_NOT_FOUND"));
					}
				}
				elseif (isset($get->id) && is_numeric($get->id) && strtolower($get->action) == "inactive") {
					try {
						$command = FactoryCommand::createCommandInactiveUser(FactoryEntity::createUser($get->id));
						$command->execute();
						$return = $mapper->fromEntityToDTO($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (UserNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_USER_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_USER_NOT_FOUND"));
					}
				}
				elseif (isset($put->user) && is_numeric($put->user) && isset($put->plan) && is_numeric($put->plan)) {
					$put = json_decode(file_get_contents('php://input'));
					$command = FactoryCommand::createCommandSetUserPlan($put->user, $put->plan);
					try {
						$command->execute();
						$return = $mapper->fromEntityToDTO($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $e) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (UserNotFoundException $e) {
						$return = new ErrorResponse(Values::getText("ERROR_USER_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_USER_NOT_FOUND"));
					}
				}
				elseif (isset($put->password) && !empty($put->password)) {
					try {
						$command = FactoryCommand::createCommandChangeUserPassword($loggedUser, $put->password);
						$command->execute();
						$return = $mapper->fromEntityToDTO($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (UserNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_USER_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_USER_NOT_FOUND"));
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
	case "POST":
		$post = json_decode(file_get_contents('php://input'));
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				if (Validate::id($post)) {
					$command = FactoryCommand::createCommandGetUserById($post->id);
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (MultipleUserException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_MULTIPLE_USER"));
						Tools::setResponse(Values::getValue("ERROR_MULTIPLE_USER"));
					}
					catch (UserNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_USER_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_USER_NOT_FOUND"));
					}
				}
				if (isset($get->profile) && $get->profile = true) {

					$command = FactoryCommand::createCommandGetUserById($loggedUser);
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (MultipleUserException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_MULTIPLE_USER"));
						Tools::setResponse(Values::getValue("ERROR_MULTIPLE_USER"));
					}
					catch (UserNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_USER_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_USER_NOT_FOUND"));
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
	default:
		break;
}