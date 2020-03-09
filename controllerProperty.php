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
		if (Validate::id($get)) {
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
					catch (PropertyExtraNotFoundException $exception) {
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
				$property = $mapper->fromEntityToDto($command->return());
				/** @var PropertyPrice[] $propertyPrice */
				$propertyPrice = $mapperPropertyPrice->fromDtoArrayToEntityArray($post->property->price);
				$propertyPrice[0]->setPropertyId($property->id);
				/** @var PropertyPrice[] $propertyPrice */
				$command = FactoryCommand::createCommandCreatePropertyPrice($propertyPrice[0]);
				$command->execute();
				$property->price = $mapperPropertyPrice->fromEntityToDto($command->return());
				if (isset($post->property->extras)) {
					/** @var PropertyExtra[] $propertyExtra */
					$propertyExtra = $mapperExtra->fromDtoArrayToEntityArray($post->property->extras);
					foreach ($propertyExtra as $extra) {
						$extra->setPropertyId($property->id);
					}
					$command = FactoryCommand::createCommandCreatePropertyExtra($propertyExtra);
					$command->execute();
					/** @var PropertyExtra[] $post ->property->extras */
					$property->extras = $mapperExtra->fromEntityArrayToDtoArray($command->return());
				}
				$return = $property;
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (PropertyExtraNotFoundException $e) {
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
			$command = FactoryCommand::createCommandDeletePropertyById(FactoryEntity::createProperty($get->id));
			try {
				$command->execute();
				$return = $mapper->fromEntityArrayToDTOArray($command->return());
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (PropertyNotFoundException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_PROPERTY_NOT_FOUND"));
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