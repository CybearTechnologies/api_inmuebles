<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperSeat();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$command = FactoryCommand::createGetSeatByIdCommand($get->id);
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityToDTO($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], 'Error de conexión.');
				Result::setResponse($exception->getCode());
			}
			catch (SeatNotFoundException $exception) {
				$return = new Result(false, [], 'Sede #' . $get->id . ' no encontrada.');
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
				$return = new Result(false, [], 'Error de conexión.');
				Result::setResponse($exception->getCode());
			}
			catch (SeatNotFoundException $exception) {
				$return = new Result(false, [], 'No se encontraron sedes.');
				Result::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		break;
}