<?php
require_once "vendor/autoload.php";
Tools::headers();
$get = Tools::getObject();
$post = Tools::postObject();
$headers = apache_request_headers();
$return = null;
$mapper = FactoryMapper::createMapperAgency();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::application()) {
			if (Validate::id($get)) {
				$command = FactoryCommand::createCommandGetAgencyById($get->id);
				try {
					$command->execute();
					$return = $command->return();
					Tools::setResponse();
				}
				catch (DatabaseConnectionException $exception) {
					$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
					Tools::setResponse(Values::getValue("ERROR_DATABASE"));
				}
				catch (AgencyNotFoundException $exception) {
					$return = new ErrorResponse(Values::getText("ERROR_AGENCY_NOT_FOUND"));
					Tools::setResponse(Values::getValue("ERROR_AGENCY_NOT_FOUND"));
				}
			}
			elseif (Validate::id($get) && isset($get->seats)) {
				$command = FactoryCommand::createCommandGetAllSeatsByAgency($get->id);
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
				$command = FactoryCommand::createCommandGetAllAgencies();
				try {
					$command->execute();
					$return = $command->return();
					Tools::setResponse();
				}
				catch (DatabaseConnectionException $exception) {
					$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
					Tools::setResponse(Values::getValue("ERROR_DATABASE"));
				}
				catch (AgencyNotFoundException $exception) {
					$return = new ErrorResponse(Values::getText("ERROR_AGENCIES_NOT_FOUND"));
					Tools::setResponse(Values::getValue("ERROR_AGENCIES_NOT_FOUND"));
				}
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
				if (Validate::agency($post) && ImageProcessor::imageFileExist('image')) {
					try {
						$tempImage = __DIR__ . '/' . ImageProcessor::saveImage($_FILES['image']['tmp_name'],
								$post->name, 'files/agency');
						$dto = FactoryDto::createDtoAgency(-1, $post->name, Environment::baseURL() . $tempImage);
						$command = FactoryCommand::createCommandCreateAgency($mapper->fromDtoToEntity($dto));
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (AgencyAlreadyExistException $exception) {
						$return = new ErrorResponse(Values::getText('ERROR_AGENCY_ALREADY_EXIST'));
						Tools::setResponse(Values::getValue('ERROR_AGENCY_ALREADY_EXIST'));
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText('ERROR_DATABASE'));
						Tools::setResponse(Values::getValue('ERROR_DATABASE'));
					}
					catch (FileIsNotImageException $exception) {
						$return = $exception->getMessage();
						Tools::setResponse($exception->getCode());
					}
					catch (ImageNotFoundException $exception) {
						$return = $exception->getMessage();
						Tools::setResponse($exception->getCode());
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
					$command = FactoryCommand::createCommandDeleteAgencyById(FactoryEntity::createAgency($get->id));
					try {
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (AgencyNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_AGENCY_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_AGENCY_NOT_FOUND"));
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
				if (Validate::putAgency($put)) {
					$command = FactoryCommand::createCommandUpdateAgencyById($mapper->fromDtoToEntity($put));
					try {
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (AgencyNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_AGENCY_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_AGENCY_NOT_FOUND"));
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
				}
				elseif (isset($get->id) && is_numeric($get->id) && strtolower($get->action) == "active") {
					$command = FactoryCommand::createCommandActiveAgencyById(FactoryEntity::createAgency($get->id));
					try {
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (AgencyNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_AGENCY_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_AGENCY_NOT_FOUND"));
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
				}
				elseif (isset($get->id) && is_numeric($get->id) && isset($get->action) && strtolower($get->action) == "inactive") {
					$command = FactoryCommand::createCommandInactiveAgencyById(FactoryEntity::createAgency($get->id));
					try {
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (AgencyNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_AGENCY_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_AGENCY_NOT_FOUND"));
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
	default:
		Tools::setResponse(405);
		break;
}