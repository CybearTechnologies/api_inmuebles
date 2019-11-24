<?php
require_once "autoload.php";
Tools::headers();
$return = null;
$mapper = FactoryMapper::createMapperExtra();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($_GET['id']) && is_numeric($_GET['id'])) {
			$command = FactoryCommand::createGetExtraByIdCommand($_GET['id']);
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityToDTO($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = new Result(false, [], 'Error de conexión.');
				Result::setResponse($e->getCode());
			}
			catch (ExtraNotFoundException $e) {
				$return = new Result(true, [], 'Extra no encontrado.');
				Result::setResponse($e->getCode());
			}
			echo json_encode($return);
		}
		else {
			$command = FactoryCommand::createGetAllExtraCommand();
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityArrayToDTOArray($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = new Result(false, [], 'Error de conexión.');
				Result::setResponse($e->getCode());
			}
			catch (ExtraNotFoundException $e) {
				$return = new Result(true, [], 'Extra no encontrado.');
				Result::setResponse($e->getCode());
			}
			http_response_code(200);
			echo json_encode($return);
		}
		break;
}
