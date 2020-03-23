<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperSubscription();
$mapperSubDetail = FactoryMapper::createMapperSubscriptionDetail();
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
				$return = $mapper->fromEntityArrayToDtoArray($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (SubscriptionNotFoundException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_SUBSCRIPTION_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_SUBSCRIPTION_NOT_FOUND"));
			}
		}
		echo json_encode($return);
		break;
	case "POST":
		$post = json_decode(file_get_contents('php://input'));
		if (Validate::subscription($post)) {
			/** @var DtoSubscription $post */
			$subscription = $mapper->fromDtoToEntity($post);
			/** @var SubscriptionDetail[] $subscriptionDetail */
			$subscriptionDetail = $mapperSubDetail->fromDtoArrayToEntityArray($post->detail);
			$command = FactoryCommand::createCommandSubscribeUser($subscription, $subscriptionDetail);
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
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(Values::getValue("ERROR_DATA_INCOMPLETE"));
		}
		echo json_encode($return);
		break;
	case "PUT":
		if (isset($get->accept) && isset($get->id) && is_numeric($get->id)) {
			$command = FactoryCommand::createCommandApproveSubscription($get->id);
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