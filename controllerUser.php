<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperUser();
$user = FactoryEntity::createUser(0);
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->email) && is_string($get->email)) {
			$user->setEmail($get->email);
			$command = FactoryCommand::createCommandGetUserByUsername($user);
			try {
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = Values::getText("ERROR_DATABASE");
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (MultipleUserException $exception) {
				$return = Values::getText("ERROR_MULTIPLE_USER");
				Tools::setResponse(Values::getValue("ERROR_MULTIPLE_USER"));
			}
			catch (UserNotFoundException $exception) {
				$return = Values::getText("ERROR_USER_NOT_FOUND");
				Tools::setResponse(Values::getValue("ERROR_USER_NOT_FOUND"));
			}
			echo json_encode($return);
		}
		elseif (Validate::id($get)) {
			$user->setId($get->id);
			$command = FactoryCommand::createCommandGetUserById($user);
			try {
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (MultipleUserException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_MULTIPLE_USER"));
				Tools::setResponse(Values::getValue("ERROR_MULTIPLE_USER"));
			}
			catch (UserNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_USER_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_USER_NOT_FOUND"));
			}
		}
		echo json_encode($return);
		break;
	default:
		Tools::setResponse(405);
		break;
}