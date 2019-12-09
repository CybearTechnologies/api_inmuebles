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
				$return = new Result(true, $mapper->fromEntityToDTO($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_DATABASE"));
				Result::setResponse($exception->getCode());
			}
			catch (SeatNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_SEAT_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		else {
			$command = FactoryCommand::createGetAllSeatCommand();
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityArrayToDTOArray($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_DATABASE"));
				Result::setResponse($exception->getCode());
			}
			catch (SeatNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_SEATS_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		break;
}