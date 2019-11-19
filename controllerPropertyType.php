<?php
require_once "autoload.php";
Tools::headers();
$return = null;
$mapper = FactoryMapper::createMapperPropertyType();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($_GET['id']) && is_numeric($_GET['id'])) {
			$command = FactoryCommand::createGetPropertyTypeByIdCommand($_GET['id']);
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityToDTO($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = new Result(false, [], 'Error al conectarse a la base de datos.');
				Result::setResponse(500);
			}
			catch (PropertyTypeNotFoundException $e) {
				$return = new Result(false, [], 'Propiedad no encontrada.');
				Result::setResponse();
			}
			echo json_encode($return);
		}
		else {
			$command = FactoryCommand::createGetAllPropertyTypeCommand();
			try {
				$command->execute();
				$return = array ('ok' => true, 'data' => $mapper->fromEntityArrayToDTOArray($command->return()));
			}
			catch (DatabaseConnectionException $e) {
				$return = array ('ok' => false, 'errors' => 'Error de conexion a la base de datos');
			}
			catch (PropertyTypeNotFoundException $e) {
				$return = array ('ok' => true, 'data' => array ());
			}
			http_response_code(200);
			echo json_encode($return);
		}
		break;
}