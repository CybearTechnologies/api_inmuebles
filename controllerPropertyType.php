<?php
require_once "vendor/autoload.php";
Tools::headers();
$headers = apache_request_headers();
$get = Tools::getObject();
$post = Tools::postObject();
$return = null;
$mapper = FactoryMapper::createMapperPropertyType();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				if (isset($get->id) && is_numeric($get->id)) {
					$command = FactoryCommand::createCommandGetPropertyTypeById($get->id);
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (PropertyTypeNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_PROPERTY_NOT_FOUND"));
					}
				}
				else {
					$command = FactoryCommand::createCommandGetAllPropertyType();
					try {
						$command->execute();
						$return = $mapper->fromEntityArrayToDTOArray($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (PropertyTypeNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_TYPES_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_PROPERTY_TYPES_NOT_FOUND"));
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
				if (Validate::propertyType($post) && FileHandler::fileExist('image')) {
					try {
						$tempImage = FileHandler::save('image', $post->name, 'files/property-type');
						$dto = FactoryDto::createDtoPropertyType(-1, $post->name, Environment::baseURL() . $tempImage);
						$propertyType = $mapper->fromDTOToEntity($dto);
						$propertyType->setUserModifier($loggedUser);
						$command = FactoryCommand::createCommandCreatePropertyType($propertyType);
						$command->execute();
						$return = $mapper->fromEntityToDTO($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						FileHandler::remove($tempImage);
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (PropetyTypeAlreadyExistException $exception) {
						FileHandler::remove($tempImage);
						$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_TYPE_ALREADY_EXIST"));
						Tools::setResponse(Values::getValue("ERROR_PROPERTY_TYPE_ALREADY_EXIST"));
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