<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperUser();
$user = FactoryEntity::createUser(0);
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::id($get)) {
			$command = FactoryCommand::createCommandGetUserById($get->id);
			try {
				$command->execute();
				$return = $command->return();
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
		elseif (isset($get->email) && is_string($get->email)) {
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
		}
		else {
			$command = FactoryCommand::createCommandGetAllUser();
			try {
				$command->execute();
				$return = $mapper->fromEntityArrayToDtoArray($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (UserNotFoundException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_USER_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_USER_NOT_FOUND"));
			}
		}
		echo json_encode($return);
		break;
	case "PUT":
		$put = json_decode(file_get_contents('php://input'));
		if (Validate::putRol($put)) {
			try {
				$command = FactoryCommand::createCommandUpdateUser($mapper->fromDtoToEntity($put));
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (UserNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_USER_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_USER_NOT_FOUND"));
			}
		}
		elseif (isset($get->id) && is_numeric($get->id) && strtolower($get->action) == "active") {
			try {
				$command = FactoryCommand::createCommandActivateUser(FactoryEntity::createUser($get->id));
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (UserNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_USER_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_USER_NOT_FOUND"));
			}
		}
		elseif (isset($get->id) && is_numeric($get->id) && strtolower($get->action) == "inactive") {
			try {
				$command = FactoryCommand::createCommandInactiveUser(FactoryEntity::createUser($get->id));
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (UserNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_USER_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_USER_NOT_FOUND"));
			}
		}
		elseif (isset($put->user) && is_numeric($put->user) && isset($put->plan) && is_numeric($put->plan)) {
			$put = json_decode(file_get_contents('php://input'));
			$command = FactoryCommand::createCommandSetUserPlan($put->user, $put->plan);
			try {
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (UserNotFoundException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_USER_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_USER_NOT_FOUND"));
			}
		}
		elseif (isset ($put->user) && is_numeric($put->user) && isset($put->password) && !empty($put->password)) {
			try {
				$command = FactoryCommand::createCommandChangeUserPassword($put->user, $put->password);
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (UserNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_USER_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_USER_NOT_FOUND"));
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(Values::getValue("ERROR_DATA_INCOMPLETE"));
		}
		echo json_encode($return);
		break;
	default:
		break;
}