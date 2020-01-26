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
			$command = FactoryCommand::createGetUserByUsernameCommand($user);
			try {
				$command->execute();
				$return = new ErrorResponse(true, $mapper->fromEntityToDTO($command->return()));
				ErrorResponse::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_DATABASE"));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (MultipleUserException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_MULTIPLE_USER"));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (UserNotFoundException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_USER_NOT_FOUND"));
				ErrorResponse::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		elseif (isset($get->id) && is_numeric($get->id)) {
			$user->setId($get->id);
			$command = FactoryCommand::createGetUserByIdCommand($user);
			try {
				$command->execute();
				$return = new ErrorResponse(true, $mapper->fromEntityToDTO($command->return()));
				ErrorResponse::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_DATABASE"));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (MultipleUserException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_MULTIPLE_USER"));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (UserNotFoundException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_USER_NOT_FOUND"));
				ErrorResponse::setResponse($exception->getCode());
			}
		}
		echo json_encode($return);
		break;
}