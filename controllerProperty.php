<?php
require_once "vendor/autoload.php";
Tools::headers();
$get = Tools::getObject();
$headers = apache_request_headers();
$return = null;
$mapper = FactoryMapper::createMapperProperty();
$mapperExtra = FactoryMapper::createMapperPropertyExtra();
$mapperPropertyPrice = FactoryMapper::createMapperPropertyPrice();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				if (Validate::id($get)) {
					$command = FactoryCommand::createCommandGetPropertyById($get->id,$loggedUser);
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (PropertyNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_PROPERTY_NOT_FOUND"));
					}
				}
				else {
					$command = FactoryCommand::createCommandListProperties($loggedUser);
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (PropertyNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_PROPERTIES_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_PROPERTIES_NOT_FOUND"));
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
				if (isset($post->name) && !empty($post->name)
					&& isset($post->area) && is_numeric($post->area)
					&& isset($post->description) && !empty($post->description)
					&& isset($post->state) && is_numeric($post->state)
					&& isset($post->floor) && is_numeric($post->floor)
					&& isset($post->type) && is_numeric($post->type)
					&& isset($post->location) && is_numeric($post->location)
					&& isset($post->price) && is_numeric($post->price)) {
					$property = FactoryEntity::createProperty(-1,0,
						$post->name, $post->area, $post->description,
						$post->state, $post->floor, $post->type, $post->location);
					$property->setUserCreator($loggedUser);
					$command = FactoryCommand::createCommandCreateProperty($property);
					$command->execute();
					$property = $mapper->fromEntityToDto($command->return());
					if (isset($post->extras) && is_array($post->extras) && !empty($post->extras)) {
						foreach ($post->extras as $extra) {
							$command = FactoryCommand::createCommandCreatePropertyExtra($extra->extra, $extra->amount,
								$property->id, $loggedUser);
							$command->execute();
							array_push($property->extras, $mapperExtra->fromEntityToDto($command->return()));
						}
					}

					$command = FactoryCommand::createCommandCreatePropertyPrice($post->price, $property->id,
						$loggedUser);
					$command->execute();
					$price = $mapperPropertyPrice->fromEntityToDto($command->return());
					array_push($property->price, $price);
					$return = $property;
					Tools::setResponse();
				}
				elseif ($get->action = "user") {
					$command = FactoryCommand::createCommandGetAllUserProperties($post->id);
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
			/*			catch (Exception $exception) {
							Logger::exception($exception, Logger::ERROR);
							$return = new ErrorResponse($exception->getMessage());
							Tools::setResponse(Values::getValue('ERROR_LOGIN_USER_NOT_LOGGED'));
						}*/
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
				if (isset($put->price) && isset($put->property) && isset($get->price)) {
					$command = FactoryCommand::createCommandCreatePropertyPrice($put->price, $put->property,
						$loggedUser);
					$command->execute();
					$return = $mapperPropertyPrice->fromEntityToDto($command->return());
				}
				elseif (Validate::activeProperty($get)) {
					try {
						$command = FactoryCommand::createCommandActiveProperty($get->id, $loggedUser);
						$command->execute();
						$return = $mapper->fromEntityToDTO($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (PropertyNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_PROPERTY_NOT_FOUND"));
					}
				}
				elseif (Validate::inactiveProperty($get)) {
					try {
						$command = FactoryCommand::createCommandInactiveProperty($get->id, $loggedUser);
						$command->execute();
						$return = $mapper->fromEntityToDTO($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (PropertyNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_PROPERTY_NOT_FOUND"));
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
				if (Validate::id($get)) {
					$command = FactoryCommand::createCommandDeletePropertyById(FactoryEntity::createProperty($get->id));
					try {
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
					}
					catch (DatabaseConnectionException $e) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (PropertyNotFoundException $e) {
						$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_PROPERTY_NOT_FOUND"));
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