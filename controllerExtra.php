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
				$return = new Result(false, [], 'Error al conectarse a la base de datos.');
				Result::setResponse(500);
			}
			catch (ExtraNotFoundException $e) {
				$return = new Result(false, [], 'Extra no encontrada.');
				Result::setResponse();
			}
			echo json_encode($return);
		}
		else {
			$command = FactoryCommand::createGetAllExtraCommand();
			try {
				$command->execute();
				$return = array ('ok' => true, 'data' => $mapper->fromEntityArrayToDTOArray($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = array ('ok' => false, 'errors' => 'Error de conexion a la base de datos');
				Result::setResponse(500);
			}
			catch (ExtraNotFoundException $e) {
				$return = array ('ok' => true, 'data' => array ());
				Result::setResponse();
			}
			http_response_code(200);
		}
		break;
}
