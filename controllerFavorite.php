<?php
require_once "vendor/autoload.php";
Tools::headers();
$get = Tools::getObject();
$post = Tools::postObject();
$return = null;
$mapper = FactoryMapper::createMapperExtra();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::id($get->id)) {
			$command = FactoryCommand::createCommandGetAllFavoriteByUserId($get->id);
			try {
				$command->execute();
				$return = $command->return();
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (FavoriteNotFoundException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_FAVORITE_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_FAVORITE_NOT_FOUND"));
			}
			catch (CustomException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
		}
		echo json_encode($return);
		break;
	case "POST":
		$post = json_decode(file_get_contents('php://input'));
		if (Validate::favorite($post)) {
			$command = FactoryCommand::createCommandCreateFavorite(FactoryEntity::createFavorite($post->id,
				$post->property));
			try {
				$command->execute();
				$return = $command->return();
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
		}
		echo json_encode($return);
		break;
	case "DELETE":
		if (Validate::id($get)) {
			$command = FactoryCommand::createCommandDeleteFavorite($get->id);
			try {
				$command->execute();
				$return = $command->return();
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (FavoriteNotFoundException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_FAVORITE_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_FAVORITE_NOT_FOUND"));
			}
		}
		echo json_encode($return);
		break;
	default:
		Tools::setResponse(405);
		break;
}