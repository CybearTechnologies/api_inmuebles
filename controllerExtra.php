<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperExtra();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$command = FactoryCommand::createGetExtraByIdCommand($get->id);
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityToDTO($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("DATABASE_ERROR"));
				Result::setResponse($exception->getCode());
			}
			catch (ExtraNotFoundException $exception) {
				$return = new Result(true, [], Values::getText("EXTRA_NOT_FOUND"));
				Result::setResponse($exception->getCode());
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
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("DATABASE_ERROR"));
				Result::setResponse($exception->getCode());
			}
			catch (ExtraNotFoundException $exception) {
				$return = new Result(true, [], Values::getText("EXTRAS_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
			http_response_code(200);
			echo json_encode($return);
		}
		break;
}
