<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperProperty();
$mapperExtra = FactoryMapper::createMapperExtra();
$mapperPropertyPrice = FactoryMapper::createMapperPropertyPrice();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$command = FactoryCommand::createGetPropertyByIdCommand($get->id);
			try {
				$command->execute();
				$dto = $mapper->fromEntityToDTO($command->return());
				if (isset($_GET['extras'])) {
					$command = FactoryCommand::createGetAllExtrasByPropertyIdCommand($get->id);
					try {
						$command->execute();
						$dto->extras = $mapperExtra->fromEntityArrayToDtoArray($command->return());
						if (isset($_GET['price'])) {
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
				$return = new Result(false, [], 'Error de conexión.');
				Result::setResponse($exception->getCode());
			}
			catch (PropertyNotFoundException $exception) {
				$return = new Result(false, [], 'Propiedad #' . $get->id . ' no encontrada.');
				Result::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		else {
			$command = FactoryCommand::createGetAllAgenciesCommand();
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityArrayToDTOArray($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], 'Error de conexión.');
				Result::setResponse($exception->getCode());
			}
			catch (AgencyNotFoundException $exception) {
				$return = new Result(false, [], 'No se encontraron inmobiliarias.');
				Result::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		break;
}