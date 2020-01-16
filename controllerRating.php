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
				$return = new Result(true, $mapper->fromEntityToDTO($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_DATABASE"));
				Result::setResponse($exception->getCode());
			}
			catch (RatingNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_RATING_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		elseif (isset($get->id_user) && is_numeric($get->id_user)) {
			$user->setId($get->id_user);
			$command = FactoryCommand::createGetAllRatingByUserCommand($user);
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityArrayToDTOArray($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_DATABASE"));
				Result::setResponse($exception->getCode());
			}
			catch (RatingNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_RATING_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		break;
}