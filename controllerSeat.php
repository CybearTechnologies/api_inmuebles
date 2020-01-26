<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperSeat();
$seat = FactoryEntity::createSeat(0);
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$seat->setId($get->id);
			$command = FactoryCommand::createGetSeatByIdCommand($seat);
			try {
				$command->execute();
				$return = new ErrorResponse(true, $mapper->fromEntityToDTO($command->return()));
				ErrorResponse::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_DATABASE"));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (SeatNotFoundException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_SEAT_NOT_FOUND"));
				ErrorResponse::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		else {
			$command = FactoryCommand::createGetAllSeatCommand();
			try {
				$command->execute();
				$return = new ErrorResponse(true, $mapper->fromEntityArrayToDTOArray($command->return()));
				ErrorResponse::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_DATABASE"));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (SeatNotFoundException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_SEATS_NOT_FOUND"));
				ErrorResponse::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		break;
}