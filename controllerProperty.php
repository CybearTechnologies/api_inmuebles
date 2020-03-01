<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperProperty();
$mapperExtra = FactoryMapper::createMapperPropertyExtra();
$mapperPropertyPrice = FactoryMapper::createMapperPropertyPrice();
$property = FactoryEntity::createProperty(0);
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$property->setId($get->id);
			$command = FactoryCommand::createCommandGetPropertyById($property);
			try {
				$command->execute();
				$dto = $mapper->fromEntityToDTO($command->return());
				if (isset($get->extras)) {
					$command = FactoryCommand::createCommandGetAllExtrasByPropertyId($property);
					try {
						$command->execute();
						$dto->extras = $mapperExtra->fromEntityArrayToDtoArray($command->return());
						if (isset($get->price)) {
							$command = FactoryCommand::createCommandGetPropertyPriceByPropertyId(FactoryEntity::createPropertyPrice(-1,
								-1, false, $property->getId()));
							try {
								$command->execute();
								$dto->price = $mapperPropertyPrice->fromEntityArrayToDtoArray($command->return());
							}
							catch (InvalidPropertyPriceException $exception) {
								unset($dto->price);
							}
						}
					}
					catch (ExtraNotFoundException $exception) {
						unset($dto->extras);
					}
				}
				else
					unset($dto->seats);
				$return = $dto;
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (PropertyNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_PROPERTY_NOT_FOUND"));
			}
			echo json_encode($return);
		}
		else {
			$command = FactoryCommand::createCommandGetAllProperty();
			try {
				$command->execute();
				$return = $mapper->fromEntityArrayToDTOArray($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (PropertyNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PROPERTIES_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_PROPERTIES_NOT_FOUND"));
			}
			echo json_encode($return);
		}
		break;
	case "POST":
		$post = json_decode(file_get_contents('php://input'));
		if (isset($post->property) /*&& Validate::property($post->property)*/) {
			$command = FactoryCommand::createCommandCreateProperty($mapper->fromDTOToEntity($post->property));
			try {
				$command->execute();
				$post->property->id = $command->return()->getId();
				$propertyPrice = $mapperPropertyPrice->fromDtoArrayToEntityArray($post->property->price);
				/** @var PropertyPrice[] $propertyPrice */
				$command = FactoryCommand::createCommandCreatePropertyPrice($propertyPrice[0]);
				$command->execute();
				if (isset($post->property->extras)) {
					$propertyExtra = $mapperExtra->fromDtoArrayToEntityArray($post->property->extras);
				}
				$return = $post;
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (InvalidPropertyPriceException $e) {
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