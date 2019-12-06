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
						if (isset($get->extra)) {
							$command = FactoryCommand::createGetPropertyPriceByPropertyIdCommand($get->id);
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
				$return = new Result(true, $dto);
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("DATABASE_ERROR"));
				Result::setResponse($exception->getCode());
			}
			catch (PropertyNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("PROPERTY_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		else {
			$command = FactoryCommand::createGetAllPropertyCommand();
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityArrayToDTOArray($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("DATABASE_ERROR"));
				Result::setResponse($exception->getCode());
			}
			catch (PropertyNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("PROPERTIES_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		break;
}