<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperSubscription();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::id($get)) {
			$command = FactoryCommand::createCommandGetSubscription($get->id);
			try {
				$command->execute();
				$return = $command->return();
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (SubscriptionNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_SUBSCRIPTION_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_SUBSCRIPTION_NOT_FOUND"));
			}
			catch (CustomException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
		}
		else {
			$command = FactoryCommand::createCommandGetAllSubscription();
			try {
				$command->execute();
				$return = $command->return();
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
		}
		echo json_encode($return);
		break;
	case "POST":
		echo json_encode($return);
		break;
	case "PUT":
		if (isset($get->accept) && isset($get->id) && is_numeric($get->id)) {
			$command = FactoryCommand::createCommandAcceptSubscription($get->id);
			try {
				$command->execute();
				$return = $command->return();
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (SubscriptionNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_SUBSCRIPTION_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_SUBSCRIPTION_NOT_FOUND"));
			}
		}
		if (isset($get->decline) && isset($get->id) && is_numeric($get->id)) {
			$command = FactoryCommand::createCommandDenySubscription($get->id);
			try {
				$command->execute();
				$return = $command->return();
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (SubscriptionNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_SUBSCRIPTION_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_SUBSCRIPTION_NOT_FOUND"));
			}
		}
		echo json_encode($return);
		break;
	case "DELETE":
		echo json_encode($return);
		break;
}