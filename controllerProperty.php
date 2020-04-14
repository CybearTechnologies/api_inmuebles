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
					$command = FactoryCommand::createCommandGetPropertyById($get->id);
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
					$command = FactoryCommand::createCommandListProperties();
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
				if (isset($post->property) /*&& Validate::property($post->property)*/) {
					$command = FactoryCommand::createCommandCreateProperty($mapper->fromDTOToEntity($post->property));
					try {
						$command->execute();
						$property = $mapper->fromEntityToDto($command->return());
						/** @var PropertyPrice[] $propertyPrice */
						$propertyPrice = $mapperPropertyPrice->fromDtoArrayToEntityArray($post->property->price);
						$propertyPrice[0]->setPropertyId($property->id);
						/** @var PropertyPrice[] $propertyPrice */
						$command = FactoryCommand::createCommandCreatePropertyPrice($propertyPrice[0]);
						$command->execute();
						$property->price = $mapperPropertyPrice->fromEntityToDto($command->return());
						if (isset($post->property->extras)) {
							/** @var PropertyExtra[] $propertyExtra */
							$propertyExtra = $mapperExtra->fromDtoArrayToEntityArray($post->property->extras);
							foreach ($propertyExtra as $extra) {
								$extra->setPropertyId($property->id);
							}
							$command = FactoryCommand::createCommandCreatePropertyExtra($propertyExtra);
							$command->execute();
							/** @var PropertyExtra[] $post ->property->extras */
							$property->extras = $mapperExtra->fromEntityArrayToDtoArray($command->return());
						}
						$return = $property;
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (PropertyExtraNotFoundException $e) {
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
	case "PUT":
		$put = json_decode(file_get_contents('php://input'));
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				if (Validate::activeProperty($get)) {
					try {
						$command = FactoryCommand::createCommandActiveProperty(FactoryEntity::createProperty($get->id));
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
						$command = FactoryCommand::createCommandInactiveProperty(FactoryEntity::createProperty($get->id));
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