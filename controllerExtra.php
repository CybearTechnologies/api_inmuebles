<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$post = Tools::postObject();
$return = null;
$mapper = FactoryMapper::createMapperExtra();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::id($get)) {
			$command = FactoryCommand::createCommandGetExtraById(FactoryEntity::createExtra($get->id));
			try {
				$command->execute();
				$return = $command->return();
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (ExtraNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_EXTRA_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_EXTRA_NOT_FOUND"));
			}catch (CustomException $exception){
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
		}
		else if (isset($get->state)) {
			if (strtolower($get->state) == "active")
				$get->state = true;
			if (strtolower($get->state) == "inactive")
				$get->state = false;
			$extra = FactoryEntity::createExtra(-1, "", "",
				-1, -1,
				"", "",
				$get->state);
			$command = FactoryCommand::createCommandGetAllExtraByState($extra);
			try {
				$command->execute();
				$return = $mapper->fromEntityArrayToDtoArray($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (ExtraNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_EXTRA_NOT_FOUND"));
				Tools::setResponse(Values::getText("ERROR_EXTRA_NOT_FOUND"));
			}
		}
		else {
			$command = FactoryCommand::createCommandGetAllExtra();
			try {
				$command->execute();
				$return = $mapper->fromEntityArrayToDTOArray($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (ExtraNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_EXTRAS_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_EXTRAS_NOT_FOUND"));
			}
		}
		echo json_encode($return);
		break;
	case "POST":
		if (Validate::extra($post) && ImageProcessor::imageFileExist('image')) {
			try {
				$tempImage = __DIR__ . '/' . ImageProcessor::saveImage($_FILES['image']['tmp_name'],
						$post->name, 'photos/extra');
				$dto = FactoryDto::createDtoExtra(-1, $post->name, Environment::baseURL() . $tempImage);
				$command = FactoryCommand::createCommandCreateExtra($mapper->fromDTOToEntity($dto));
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (FileIsNotImageException $exception) {
				$return = $exception->getMessage();
				Tools::setResponse($exception->getCode());
			}
			catch (ImageNotFoundException $exception) {
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
	case "DELETE":
		if (isset($get->id) && is_numeric($get->id)) {
			$extra = FactoryEntity::createExtra($get->id);
			$command = FactoryCommand::createCommandDeleteExtraById($extra);
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
		}
		echo json_encode($return);
		break;
	case "PUT":
		$put = json_decode(file_get_contents('php://input'));
		if (Validate::putExtra($put)) {
			$command = FactoryCommand::createCommandUpdateExtraById($mapper->fromDtoToEntity($put));
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (ExtraNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_EXTRA_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_EXTRA_NOT_FOUND"));
			}
		}
		elseif (isset($get->id) && is_numeric($get->id) && isset($get->action) && strtolower($get->action) == "active") {
			$command = FactoryCommand::createCommandActiveExtraById(FactoryEntity::createExtra($get->id));
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (ExtraNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_EXTRA_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_EXTRA_NOT_FOUND"));
			}
		}
		elseif (isset($get->id) && is_numeric($get->id) && isset($get->action) && strtolower($get->action) == "inactive") {
			$command = FactoryCommand::createCommandInactiveExtraById(FactoryEntity::createExtra($get->id));
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (ExtraNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_EXTRA_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_EXTRA_NOT_FOUND"));
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(Values::getValue("ERROR_DATA_INCOMPLETE"));
		}
		echo json_encode($return);
		break;
	default:
		Tools::setResponse(405);
		break;
}
