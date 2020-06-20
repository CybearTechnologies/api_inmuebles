<?php
require_once "vendor/autoload.php";
Tools::headers();
$get = Tools::getObject();
$post = Tools::postObject();
$headers = apache_request_headers();
$return = null;
$mapper = FactoryMapper::createMapperExtra();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				if (Validate::id($get)) {
					$command = FactoryCommand::createCommandGetExtraById($get->id);
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (ExtraNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_EXTRA_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_EXTRA_NOT_FOUND"));
					}
					catch (CustomException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
				}
				elseif (isset($get->state)) {
					if (strtolower($get->state) == "active")
						$get->state = true;
					if (strtolower($get->state) == "inactive")
						$get->state = false;
					$extra = FactoryEntity::createExtra(-1, "", "",
						-1, -1,
						"", "",
						$get->state);
					$command = FactoryCommand::createCommandGetAllExtraByState($extra);
					try {
						$command->execute();
						$return = $mapper->fromEntityArrayToDtoArray($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (ExtraNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_EXTRA_NOT_FOUND"));
						Tools::setResponse(Values::getText("ERROR_EXTRA_NOT_FOUND"));
					}
				}
				elseif (isset($get->property) && is_numeric($get->property)) {
					$command = FactoryCommand::createCommandGetAllExtrasByPropertyId($get->property);
					$command->execute();
					$return = $command->return();
					Tools::setResponse();
				}
				else {
					$command = FactoryCommand::createCommandGetAllExtra();
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (ExtraNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_EXTRAS_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_EXTRAS_NOT_FOUND"));
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
				if (Validate::extra($post) && FileHandler::fileExist('image') && isset($get->create)) {
					try {
						$tempImage = FileHandler::save('image', $post->name, 'files/extra');
						$command = FactoryCommand::createCommandCreateExtra($post->name, $tempImage, $loggedUser);
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						FileHandler::remove($tempImage);
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
				}
				elseif (Validate::putExtra($post) && FileHandler::fileExist('image') && isset($get->update)) {
					$command = FactoryCommand::createCommandGetExtraById($post->id);
					try {
						$command->execute();
						$extra = $command->return();
						$length = strlen(Environment::baseURL()) - 1;
						$tempImage = FileHandler::replace($extra->icon, 'image', $post->name, 'files/extra');
						$command = FactoryCommand::createCommandUpdateExtraById($post->id, $post->name,
							Environment::baseURL() . $tempImage, $loggedUser);
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (ExtraNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_EXTRA_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_EXTRA_NOT_FOUND"));
					}
				}
				elseif (Validate::putExtra($post) && isset($get->update)) {
					$command = FactoryCommand::createCommandGetExtraById($post->id);
					try {
						$command->execute();
						$extra = $command->return();
						$command = FactoryCommand::createCommandUpdateExtraById($post->id, $post->name,
							$extra->icon, $loggedUser);
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (ExtraNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_EXTRA_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_EXTRA_NOT_FOUND"));
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
	case "DELETE":
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				if (isset($get->id) && is_numeric($get->id)) {
					$command = FactoryCommand::createCommandDeleteExtraById($get->id, $loggedUser);
					try {
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();

					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
				}
				else {
					$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
					Tools::setResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
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
			echo "mano paso por aqui7";
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
				if (Validate::putExtra($put) && FileHandler::fileExist('image')) {
					$command = FactoryCommand::createCommandGetExtraById($put->id);
					try {
						$command->execute();
						$extra = $command->return();
						$tempImage = FileHandler::replace($extra->icon, 'image', $post->name, 'files/extra');
						$command = FactoryCommand::createCommandUpdateExtraById($put->id, $put->name, $tempImage,
							$loggedUser);
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (ExtraNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_EXTRA_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_EXTRA_NOT_FOUND"));
					}
				}
				elseif (isset($get->id) && is_numeric($get->id) && isset($get->action) && strtolower($get->action) == "active") {
					$command = FactoryCommand::createCommandActiveExtraById($get->id, $loggedUser);
					try {
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (ExtraNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_EXTRA_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_EXTRA_NOT_FOUND"));
					}
				}
				elseif (isset($get->id) && is_numeric($get->id) && isset($get->action) && strtolower($get->action) == "inactive") {
					$command = FactoryCommand::createCommandInactiveExtraById($get->id, $loggedUser);
					try {
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (ExtraNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_EXTRA_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_EXTRA_NOT_FOUND"));
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
	default:
		Tools::setResponse(405);
		break;
}
