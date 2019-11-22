<?php
require_once "autoload.php";
Tools::headers();
$return = null;
$mapper = FactoryMapper::createMapperLocation();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($_GET['id']) && is_numeric($_GET['id'])) {
			$command = FactoryCommand::createGetLocationByIdCommand($_GET['id']);
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityToDTO($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = new Result(false, [], 'Error al conectarse a la base de datos.');
				Result::setResponse(500);
			}
			catch (LocationNotFoundException $e) {
				$return = new Result(false, [], 'Extra no encontrada.');
				Result::setResponse();
			}
			echo json_encode($return);
		}
		else if(isset($_GET['name']) && is_string($_GET['name'])) {
			$command = FactoryCommand::createGetLocationByNameCommand($_GET['name']);
			try {
				$command->execute();
				$return = array ('ok' => true, 'data' => $mapper->fromEntityArrayToDTOArray($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = array ('ok' => false, 'errors' => 'Error de conexion a la base de datos');
				Result::setResponse(500);
			}
			catch (LocationNotFoundException $e) {
				$return = array ('ok' => true, 'data' => array ());
				Result::setResponse();
			}
			http_response_code(200);
			echo json_encode($return);
		}
		else if(isset($_GET['type']) && is_string($_GET['type'])) {
			$command = FactoryCommand::createGetLocationsByTypeCommand($_GET['type']);
			try {
				$command->execute();
				$return = array ('ok' => true, 'data' => $mapper->fromEntityArrayToDTOArray($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = array ('ok' => false, 'errors' => 'Error de conexion a la base de datos');
				Result::setResponse(500);
			}
			catch (LocationNotFoundException $e) {
				$return = array ('ok' => true, 'data' => array ());
				Result::setResponse();
			}
			http_response_code(200);
			echo json_encode($return);
		}
		break;
}
