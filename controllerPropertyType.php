<?php
require_once "vendor/autoload.php";
Tools::headers();
$get = Tools::getObject();
$post = Tools::postObject();
$return = null;
$mapper = FactoryMapper::createMapperPropertyType();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$propertyType = FactoryEntity::createPropertyType($get->id);
			$command = FactoryCommand::createCommandGetPropertyTypeById($propertyType);
			try {
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (PropertyTypeNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_PROPERTY_NOT_FOUND"));
			}
		}
		else {
			$command = FactoryCommand::createCommandGetAllPropertyType();
			try {
				$command->execute();
				$return = $mapper->fromEntityArrayToDTOArray($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (PropertyTypeNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_TYPES_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_PROPERTY_TYPES_NOT_FOUND"));
			}
		}
		echo json_encode($return);
		break;
	case "POST":
		if (Validate::propertyType($post) && ImageProcessor::imageFileExist('image')) {
			try {
				$tempImage = ImageProcessor::saveImage($_FILES['image']['tmp_name'],
					$post->name, 'files/property-type');
				$dto = FactoryDto::createDtoPropertyType(-1, $post->name, Environment::baseURL() . $tempImage);
				$command = FactoryCommand::createCommandCreatePropertyType($mapper->fromDTOToEntity($dto));
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				ImageProcessor::removeImage(__DIR__ . '/' . $tempImage);
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (PropetyTypeAlreadyExistException $exception) {
				ImageProcessor::removeImage(__DIR__ . '/' . $tempImage);
				$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_TYPE_ALREADY_EXIST"));
				Tools::setResponse(Values::getValue("ERROR_PROPERTY_TYPE_ALREADY_EXIST"));
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
	default:
		Tools::setResponse(405);
		break;
}