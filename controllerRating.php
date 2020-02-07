<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperRating();
$rating = FactoryEntity::createRating(0);
$user = FactoryEntity::createUser(0);
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$rating->setId($get->id);
			$command = FactoryCommand::createGetRatingByIdCommand($rating);
			try {
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
			catch (RatingNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_RATING_NOT_FOUND"));
				Tools::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		elseif (isset($get->id_user) && is_numeric($get->id_user)) {
			$user->setId($get->id_user);
			$command = FactoryCommand::createGetAllRatingByUserCommand($user);
			try {
				$command->execute();
				$return = $mapper->fromEntityArrayToDtoArray($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
			catch (RatingNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_RATING_NOT_FOUND"));
				Tools::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		break;
	case "POST":
		$post = json_decode(file_get_contents('php://input'));
		if (Validate::Rating($post)) {
			$command = FactoryCommand::createCreateRatingByUserIdCommand($mapper->fromDtoToEntity($post));
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(Values::getValue("ERROR_DATA_INCOMPLETE"));
		}
		echo json_encode($return);
		break;
	case "DELETE":
		if (Validate::id($get)) {
			$rating = FactoryEntity::createRating($get->id);
			$command = FactoryCommand::createDeleteRatingByIdCommand($rating);
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
			catch (RatingNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_RATING_NOT_FOUND"));
				Tools::setResponse($exception->getCode());
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(Values::getValue("ERROR_DATA_INCOMPLETE"));
		}
		echo json_encode($return);
		break;
	default:
		Tools::setResponse(404);
		break;
}