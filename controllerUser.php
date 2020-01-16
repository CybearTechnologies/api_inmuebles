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
				$return = new Result(true, $mapper->fromEntityToDTO($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_DATABASE"));
				Result::setResponse($exception->getCode());
			}
			catch (MultipleUserException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_MULTIPLE_USER"));
				Result::setResponse($exception->getCode());
			}
			catch (UserNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_USER_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		elseif (isset($get->id) && is_numeric($get->id)) {
			$user->setId($get->id);
			$command = FactoryCommand::createGetUserByIdCommand($user);
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityToDTO($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_DATABASE"));
				Result::setResponse($exception->getCode());
			}
			catch (MultipleUserException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_MULTIPLE_USER"));
				Result::setResponse($exception->getCode());
			}
			catch (UserNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_USER_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
		}
		echo json_encode($return);
		break;
}