<?php
require_once "vendor/autoload.php";
Tools::headers();
$get = Tools::getObject();
$headers = apache_request_headers();
$return = null;
$mapper = FactoryMapper::createMapperSeat();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
				$headers[Values::APPLICATION_HEADER]);
				if (Validate::id($get)) {
					$command = FactoryCommand::createCommandGetSeatById($get->id);
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (SeatNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_SEAT_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_SEAT_NOT_FOUND"));
					}
				}
				else {
					$command = FactoryCommand::createCommandGetAllSeats();
					try {
						$command->execute();
						$return = $mapper->fromEntityArrayToDTOArray($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (SeatNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_SEATS_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_SEATS_NOT_FOUND"));
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
	case 'POST':
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				$post = json_decode(file_get_contents('php://input'));
				if (Validate::seat($post)) {
					$seat = $mapper->fromDtoToEntity($post);
					$seat->setUserCreator($loggedUser);
					$command = FactoryCommand::createCommandCreateSeat($seat);
					try {
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (SeatAlreadyExistException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_SEAT_ALREADY_EXIST"));
						Tools::setResponse(Values::getValue("ERROR_SEAT_ALREADY_EXIST"));
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
					$seat = FactoryEntity::createSeat($get->id);
					$seat->setUserModifier($loggedUser);
					$command = FactoryCommand::createCommandDeleteSeatById($seat);
					try {
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (SeatNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_SEAT_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_SEAT_NOT_FOUND"));
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
				if (Validate::putSeat($put)) {
					try {
						$seat = $mapper->fromDtoToEntity($put);
						$seat->setUserModifier($loggedUser);
						$command = FactoryCommand::createCommandUpdateSeatById($seat);
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getText("ERROR_DATABASE"));
					}
					catch (SeatNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_SEAT_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_SEAT_NOT_FOUND"));
					}
				}
				elseif (isset($get->id) && is_numeric($get->id) && strtolower($get->action) == "active") {
					$command = FactoryCommand::createCommandActiveSeatById(FactoryEntity::createSeat($get->id));
					try {
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (SeatNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_SEAT_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_SEAT_NOT_FOUND"));
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
				}
				elseif (isset($get->id) && is_numeric($get->id) && strtolower($get->action) == "inactive") {
					$command = FactoryCommand::createCommandInactiveSeatById(FactoryEntity::createSeat($get->id));
					try {
						$command->execute();
						$return = $mapper->fromEntityToDto($command->return());
						Tools::setResponse();
					}
					catch (SeatNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_SEAT_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_SEAT_NOT_FOUND"));
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