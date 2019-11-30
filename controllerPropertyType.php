<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperPropertyType();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$command = FactoryCommand::createGetPropertyTypeByIdCommand($get->id);
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityToDTO($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = new Result(false, [], 'Error de conexión');
				Result::setResponse($e->getCode());
			}
			catch (PropertyTypeNotFoundException $e) {
				$return = new Result(false, [], 'Propiedad no encontrada.');
				Result::setResponse($e->getCode());
			}
		}
		else {
			$command = FactoryCommand::createGetAllPropertyTypeCommand();
			try {
				$command->execute();
				$return = array ('ok' => true, 'data' => $mapper->fromEntityArrayToDTOArray($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = new Result(false, [], 'Error de conexión');
				Result::setResponse($e->getCode());
			}
			catch (PropertyTypeNotFoundException $e) {
				$return = new Result(false, [], 'Propiedad no encontrada.');
				Result::setResponse($e->getCode());
			}
		}
		echo json_encode($return);
		break;
	case "POST":
		$post = json_decode(file_get_contents('php://input'));
		if (isset($post->name)) {
			try {
				$command = FactoryCommand::createPropertyTypeCommand($mapper->fromDTOToEntity($post));
				$command->execute();
				$return = array ('ok' => true);
				Result::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = new Result(false, [], 'Error de conexión');
				Result::setResponse($e->getCode());
			}
		}
		else {
			$return = new Result(false, [], 'Datos Incompletos');
			Result::setResponse(500);
		}
		echo json_encode($return);
		break;
	default:
		$http_response_header(404);
		break;
}