<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$post = Tools::postObject();
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
		if (Validate::subscription($post)) {
			try {
				// Files processing
				$details = [];
				if (isset($_FILES['files']) && count($_FILES['files']['size']) > 0) {
					$i = 0;
					foreach ($_FILES['files']['name'] as $file) {
						array_push($details,
							FactoryDto::createDtoSubscriptionDetail(-1,
								__DIR__ . '/' . Tools::saveFile($file, $_FILES['files']['tmp_name'][$i],
									$post->firstName . $post->lastName, 'files/user'), -1));
						$i++;
					}
					var_dump($details);
				}
				$post->password = $post->password . Environment::siteKey() . Tools::siteEncrypt($post->password);
				/** @var DtoSubscription $post */
				$subscription = $mapper->fromDtoToEntity($post);
				$command = FactoryCommand::createCommandSubscribeUser($subscription, $details);
				$command->execute();
				$return = $command->return();
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				foreach ($details as $file)
					Tools::removeFile($file->document);
				$return = new ErrorResponse($exception->getMessage());
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (FileNotFoundException $exception) {
				foreach ($details as $file)
					Tools::removeFile($file->document);
				$return = $exception->getMessage();
				Tools::setResponse($exception->getCode());
			}
			catch (SaveFileException $exception) {
				foreach ($details as $file)
					Tools::removeFile($file->document);
				$return = $exception->getMessage();
				Tools::setResponse($exception->getCode());
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(Values::getValue("ERROR_DATA_INCOMPLETE"));
		}
		echo json_encode($return);
		break;
	case "PUT":
		if (isset($get->action) && $get->action = "accept" && isset($get->id) && is_numeric($get->id)) {
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