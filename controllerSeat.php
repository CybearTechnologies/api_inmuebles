<?php
require_once "vendor/autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperSeat();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
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
			catch (CustomException $exception){
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			echo json_encode($return);
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
			echo json_encode($return);
		}
		break;
	case 'POST':
		$post = json_decode(file_get_contents('php://input'));
		if (Validate::seat($post)) {
			$command = FactoryCommand::createCommandCreateSeat($mapper->fromDtoToEntity($post));
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
		echo json_encode($return);
		break;
	case "DELETE":
		if (Validate::id($get)) {
			$seat = FactoryEntity::createSeat($get->id);
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
		echo json_encode($return);
		break;
	case "PUT":
		$put = json_decode(file_get_contents('php://input'));
		if (Validate::putSeat($put)) {
			try {
				$command = FactoryCommand::createCommandUpdateSeatById($mapper->fromDtoToEntity($put));
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
		echo json_encode($return);
		break;
	default:
		Tools::setResponse(405);
		break;
}