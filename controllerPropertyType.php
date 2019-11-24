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
				$return = new Result(false, [], 'Error de conexión');
				Result::setResponse($e->getCode());
			}
			catch (PropertyTypeNotFoundException $e) {
				$return = new Result(false, [], 'Propiedad no encontrada.');
				Result::setResponse($e->getCode());
			}
			echo json_encode($return);
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
			echo json_encode($return);
		}
		break;
}