<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperLocation();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$command = FactoryCommand::createGetLocationByIdCommand($get->id);
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityToDTO($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("DATABASE_ERROR"));
				Result::setResponse($exception->getCode());
			}
			catch (LocationNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("LOCATION_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		elseif (isset($get->type)) {
			$command = FactoryCommand::createGetLocationsByTypeCommand($get->type);
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityArrayToDTOArray($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("DATABASE_ERROR"));
				Result::setResponse($exception->getCode());
			}
			catch (LocationNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("LOCATION_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		break;
}
