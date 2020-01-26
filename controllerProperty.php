<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperProperty();
$mapperExtra = FactoryMapper::createMapperExtra();
$mapperPropertyPrice = FactoryMapper::createMapperPropertyPrice();
$property = FactoryEntity::createProperty(0);
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$property->setId($get->id);
			$command = FactoryCommand::createGetPropertyByIdCommand($property);
			try {
				$command->execute();
				$dto = $mapper->fromEntityToDTO($command->return());
				if (isset($get->extras)) {
					$command = FactoryCommand::createGetAllExtrasByPropertyIdCommand($property);
					try {
						$command->execute();
						$dto->extras = $mapperExtra->fromEntityArrayToDtoArray($command->return());
						if (isset($get->price)) {
							$command = FactoryCommand::createGetPropertyPriceByPropertyIdCommand($property);
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
				Tools::setResponse($exception->getCode());
			}
			catch (PropertyNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PROPERTY_NOT_FOUND"));
				Tools::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		else {
			$command = FactoryCommand::createGetAllPropertyCommand();
			try {
				$command->execute();
				/**
				 * @var DtoProperty[] $dtoPropertyArray
				 */
				$return = $mapper->fromEntityArrayToDTOArray($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
			catch (PropertyNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PROPERTIES_NOT_FOUND"));
				Tools::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		break;
	case "POST":
		$post = json_decode(file_get_contents('php://input'));
		if (isset($post->property) && Validate::property($post->property)) {
			$command = FactoryCommand::createCreatePropertyCommand($mapper->fromDTOToEntity($post));
			try {
				$command->execute();
				$post->property->id = $command->return()->getId();
				$command = FactoryCommand::createCreatePropertyPriceByPropertyCommand($command->return());
				$command->execute();
				$return = $post;
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse($exception->getCode());
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(500);
		}
		echo json_encode($return);
		break;
}